{{-- filepath: d:\laravel-projects\inventory-app\resources\views\transactions\index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Transactions</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('transactions.create') }}" class="btn btn-primary mb-3">Create New Transaction</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Item Name</th>
                <th>Transaction Type</th>
                <th>Quantity</th>
                <th>User Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $trx)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $trx->item->name ?? '-' }}</td>
                <td>
                    @if($trx->type == 'in')
                        <span class="badge bg-success">Masuk</span>
                    @else
                        <span class="badge bg-danger">Keluar</span>
                    @endif
                </td>
                <td>{{ $trx->quantity }}</td>
                <td>{{ $trx->user->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('transactions.show', $trx) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('transactions.edit', $trx) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('transactions.destroy', $trx) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this transaction?')" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection