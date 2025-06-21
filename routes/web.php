<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminExportController;
use App\Http\Controllers\PExportController;
use Illuminate\Http\Request;

Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function (Request $request) {
        $totalItems = \App\Models\Item::count();
        $totalTransactions = \App\Models\Transaction::count();
        $products = \App\Models\Product::orderBy('id', 'desc')->paginate(10);
        return view('dashboard', compact('totalItems', 'totalTransactions', 'products'));
    })->name('dashboard');

    Route::resource('products', \App\Http\Controllers\ProductController::class);
    Route::resource('items', ItemController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('transactions', TransactionController::class);

    Route::get('/products/export/pdf', [PExportController::class, 'exportPdf'])->name('products.export.pdf');
    Route::get('/products/export/excel', [PExportController::class, 'exportExcel'])->name('products.export.excel');
});

Auth::routes([
    'register' => true,
    'reset' => true,
    'verify' => false,
]);

// ✅ Redirect dari "/home" ke dashboard (untuk menjaga kompatibilitas dengan redirect bawaan Laravel)
Route::get('/home', function () {
    return redirect()->route('dashboard');
})->name('home');
