<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['item', 'user'])->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $items = Item::all();
        return view('transactions.create', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $item = Item::findOrFail($validated['item_id']);

        if ($validated['type'] === 'out' && $item->stock < $validated['quantity']) {
            return back()->withErrors(['quantity' => 'Not enough stock for this transaction.'])->withInput();
        }

        $transaction = new Transaction($validated);
        $transaction->user_id = Auth::user()->id;
        $transaction->save();

        if ($validated['type'] === 'in') {
            $item->stock += $validated['quantity'];
        } else {
            $item->stock -= $validated['quantity'];
        }
        $item->save();

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $items = Item::all();
        return view('transactions.edit', compact('transaction', 'items'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $item = Item::findOrFail($validated['item_id']);

        // Revert previous stock change
        if ($transaction->type === 'in') {
            $transaction->item->stock -= $transaction->quantity;
        } else {
            $transaction->item->stock += $transaction->quantity;
        }
        $transaction->item->save();

        // Check stock for 'out' type
        if ($validated['type'] === 'out' && $item->stock < $validated['quantity']) {
            return back()->withErrors(['quantity' => 'Not enough stock for this transaction.'])->withInput();
        }

        $transaction->update([
            'item_id' => $validated['item_id'],
            'type' => $validated['type'],
            'quantity' => $validated['quantity'],
            'notes' => $validated['notes'],
            'user_id' => auth()->user()->id, // assign current user
        ]);

        // Apply new stock change
        if ($validated['type'] === 'in') {
            $item->stock += $validated['quantity'];
        } else {
            $item->stock -= $validated['quantity'];
        }
        $item->save();

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        // Revert stock before deleting
        if ($transaction->type === 'in') {
            $transaction->item->stock -= $transaction->quantity;
        } else {
            $transaction->item->stock += $transaction->quantity;
        }
        $transaction->item->save();

        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
