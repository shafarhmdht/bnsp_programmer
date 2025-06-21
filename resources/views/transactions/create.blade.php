{{-- filepath: d:\laravel-projects\inventory-app\resources\views\transactions\create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Transaction</h1>
    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Item</label>
            <select name="item_id" class="form-control" required>
                <option value="">-- Select Item --</option>
                @foreach($items as $item)
                    <option value="{{ $item->id }}" {{ old('item_id')==$item->id ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
            @error('item_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Transaction Type</label>
            <select name="type" class="form-control" required>
                <option value="">-- Select Type --</option>
                <option value="in" {{ old('type')=='in' ? 'selected' : '' }}>Masuk</option>
                <option value="out" {{ old('type')=='out' ? 'selected' : '' }}>Keluar</option>
            </select>
            @error('type') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" min="1" required>
            @error('quantity') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
            @error('notes') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection