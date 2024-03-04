<?php

namespace App\Http\Controllers;

use App\Exports\ExportCustomers;
use App\Exports\ExportProducts;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportImportController extends Controller
{
    public function export()
    {
        return Excel::download(new ExportProducts(), 'products.xlsx');
    }

    public function exportToPDF()
    {

        $customers = Customer::all();

        $pdf = PDF::loadView('customers.pdf', compact('customers'));

        return $pdf->download('customers.pdf');

        //return $pdf->stream();
    }
}
