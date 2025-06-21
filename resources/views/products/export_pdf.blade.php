<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapan Produk</title>
</head>
<body>
    <h1>Rekapan Produk</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Diupdate Pada</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>Rp{{ number_format($product->price, 2, ',', '.') }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
