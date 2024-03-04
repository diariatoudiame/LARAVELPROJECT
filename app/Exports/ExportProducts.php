<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportProducts implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Description',
            'Price',
            'Quantity in Stock',
            'Photo',
            'Category ID',
            'Created At',
            'Updated At',
        ];
    }
}
