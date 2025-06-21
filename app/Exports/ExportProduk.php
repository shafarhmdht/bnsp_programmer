<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class ExportProduk implements FromCollection, WithHeadings, ShouldAutoSize, WithStrictNullComparison, WithMapping
{
    /**
     * Return a collection of products to be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::select(
            'id',
            'name',
            'description',
            'price',
            'stock',
            'created_at'
        )->get();
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->description,
            $product->price,
            $product->stock,
            $product->created_at->format('H:i d-m-Y'),
        ];
    }

    /**
     * Define the header row for the export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama Produk',
            'Deskripsi',
            'Harga',
            'Stok',
            'Created At',
        ];
    }
}