<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\ProductsExport;

class ProductController extends Controller
{
    // Menangani Pencarian dan Pagination
    public function index(Request $request)
    {
        // Ambil parameter pencarian dari input
        $search = $request->input('search');

        // Ambil produk berdasarkan pencarian jika ada
        $products = Product::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%') // Pencarian berdasarkan nama produk
                         ->orWhere('description', 'like', '%' . $search . '%'); // Pencarian berdasarkan deskripsi produk
        })
        ->paginate(10); // Gunakan pagination dengan 10 item per halaman

        // Kirim data ke view
        return view('products.index', compact('products', 'search')); // Mengirim data produk dan pencarian ke view
    }

    // Menampilkan form untuk menambah produk
    public function create()
    {
        return view('products.create');
    }

    // Menyimpan data produk baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);
        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Menampilkan detail produk berdasarkan ID
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // Menampilkan form untuk mengedit produk berdasarkan ID
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // Menyimpan perubahan produk
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);
        $product = Product::findOrFail($id);
        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // Menghapus produk berdasarkan ID
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }

    // // Method untuk ekspor produk ke PDF
    // public function exportPdf()
    // {
    //     $products = Product::all(); // Ambil semua data produk
    //     $pdf = PDF::loadView('products.pdf', compact('products'));
    //     return $pdf->download('products.pdf');
    // }

    // // Method untuk ekspor produk ke Excel
    // public function exportExcel()
    // {
    //     return Excel::download(new ProductsExport, 'products.xlsx');
    // }
}