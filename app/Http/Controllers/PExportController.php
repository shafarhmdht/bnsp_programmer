<?php

namespace App\Http\Controllers;

use App\Exports\ExportProduk;
use App\Exports\ProdukExport;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;


class PExportController extends Controller
{
    public function exportPdf()
    {
        $products = Product::all();
        $pdf = Pdf::loadView('products.export_pdf', compact('products'));
        return $pdf->download('daftar-produk.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new ExportProduk, 'daftar-produk.xlsx');
    }
}