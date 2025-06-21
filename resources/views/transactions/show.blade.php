{{-- filepath: d:\laravel-projects\inventory-app\resources\views\transactions\show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Transaction Details</h1>
    <div class="mb-3">
        <strong>Item Name:</strong> {{ $transaction->item->name ?? '-' }}
    </div>
    <div class="mb-3">
        <strong>Transaction Type:</strong>
        @if($transaction->type == 'in')
            <span class="badge bg-success">Masuk</span>
        @else
            <span class="badge bg-danger">Keluar</span>
        @endif
    </div>
    <div class="mb-3">
        <strong>Quantity:</strong> {{ $transaction->quantity }}
    </div>
    <div class="mb-3">
        <strong>User Name:</strong> {{ $transaction->user->name ?? '-' }}
    </div>
    <div class="mb-3">
        <strong>Description:</strong> {{ $transaction->notes ?? '-' }}
    </div>
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Back</a>