@extends('layouts.app')


@section('content')
<div class="container">
    <h1>Item Details</h1>
    <div class="mb-3">
        <strong>Name:</strong> {{ $item->name }}
    </div>
    <div class="mb-3">
        <strong>Category:</strong> {{ $item->category->name ?? '-' }}
    </div>
    <div class="mb-3">
        <strong>Stock:</strong> {{ $item->stock }}
    </div>
    <a href="{{ route('items.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection