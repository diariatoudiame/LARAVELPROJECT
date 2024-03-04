<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Nombre de clients dans le système
        $totalCustomers = Customer::count();

        // Nombre de clients par sexe
        $maleCustomersCount = Customer::where('gender', 'M')->count();
        $femaleCustomersCount = Customer::where('gender', 'F')->count();

        // Nombre de produits
        $totalProducts = Product::count();

        $products = Product::withCount('orders')->get();

        return view('auth.dashboard', compact('totalCustomers', 'maleCustomersCount','femaleCustomersCount', 'totalProducts','products'));
    }

}
