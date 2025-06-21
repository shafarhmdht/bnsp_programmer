@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Items</h1>
        <!-- Tombol Ekspor PDF -->
    <div class="mb-3">
        <a href="{{ route('products.export.pdf') }}" class="btn btn-danger">Ekspor ke PDF</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('items.create') }}" class="btn btn-primary mb-3">Add New Item</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category->name ?? '-' }}</td>
                <td>{{ $item->stock }}</td>
                <td>
                    <a href="{{ route('items.show', $item) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('items.edit', $item) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this item?')" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection