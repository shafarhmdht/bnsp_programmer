@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Kelola Produk</h1>
    <div class="mb-3 d-flex gap-2">
        <a href="{{ route('products.export.pdf') }}" class="btn btn-danger" target="_blank">Export PDF</a>
        <a href="{{ route('products.export.excel') }}" class="btn btn-success">Export Excel</a>
        <a href="{{ route('products.create') }}" class="btn btn-primary ms-auto">Tambah Produk</a>
    </div>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Dibuat</th>
                <th>Diperbarui</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->description }}</td>
                <td>Rp{{ number_format($p->price, 2, ',', '.') }}</td>
                <td>{{ $p->stock }}</td>
                <td>{{ $p->created_at }}</td>
                <td>{{ $p->updated_at }}</td>
                <td>
                    <a href="{{ route('products.edit', $p) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('products.destroy', $p) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection