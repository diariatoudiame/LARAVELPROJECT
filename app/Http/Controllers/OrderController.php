<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::simplePaginate(3);
        return view('orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('orders.create',
            compact('customers'),
            compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required|in:in progress,completed,cancelled',
            'order_date' => 'required|date',
            'product_id' => 'required|array|min:1',
            'product_id.*' => 'exists:products,id',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer|min:1',
        ]);

        // Création de la commande
        $order = new Order();
        $order->customer_id = $request->customer_id;
        $order->reference = $request->reference;
        $order->status = $request->status;
        $order->order_date = $request->order_date;
        $order->total_amount = 0;

        // Sauvegarde de la commande
        $order->save();

        // Calcul du montant total de la commande
        $totalAmount = 0;

        foreach ($request->product_id as $key => $productId) {
            $product = Product::find($productId);
            $quantityToOrder = $request->quantity[$key];

            if ($quantityToOrder > $product->quantity_in_stock) {
                return redirect()->back()->with('error', 'La quantité commandée dépasse le stock disponible pour le produit : ' . $product->name);
            }

            $productAmount = $product->price * $quantityToOrder;
            $totalAmount += $productAmount;

            // Attache le produit à la commande avec les détails
            $order->products()->attach($product->id, [
                'quantity' => $quantityToOrder,
                'unit_price' => $product->price,
                'total_price' => $productAmount,
            ]);

            // Met à jour la quantité en stock du produit
            $product->quantity_in_stock -= $quantityToOrder;
            $product->save();
        }

        // Met à jour le montant total de la commande
        $order->total_amount = $totalAmount;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Commande créée avec succès !');
    }


    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('orders.show',compact('order'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $products = Product::all();
        $customers = Customer::all();
        return view('orders.edit',
            compact('order','products','customers'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required|in:in progress,completed,cancelled',
            'order_date' => 'required|date',
            'product_id' => 'required|array|min:1',
            'product_id.*' => 'exists:products,id',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer|min:1',

        ]);


        $order->customer_id = $request->customer_id;
        $order->status = $request->status;
        $order->order_date = $request->order_date;
        $order->save();

        // Préparer les données pour la synchronisation
        $syncData = [];
        foreach ($request->product_id as $key => $productId) {
            $product = Product::find($productId);
            $quantityToOrder = $request->quantity[$key];

            // Vérifier si la quantité commandée est disponible en stock
            if ($quantityToOrder > $product->quantity_in_stock) {
                return redirect()->back()->with('error', 'La quantité commandée dépasse le stock disponible pour le produit : ' . $product->name);
            }

            $productAmount = $product->price * $quantityToOrder;
            $totalAmount += $productAmount;

            $syncData[$productId] = [
                'quantity' => $quantityToOrder,
                'unit_price' => $product->price,
                'total_price' => $productAmount,
            ];

            // Réduire la quantité en stock du produit
            $product->quantity_in_stock -= $quantityToOrder;
            $product->save();
        }


        // Synchroniser les produits attachés à la commande avec les nouvelles données
        $order->products()->sync($syncData);
        $order->total_amount = $totalAmount;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Commande mise à jour avec succès !');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        // Détacher tous les produits associés à la commande
        $order->products()->detach();

        // Supprimer la commande
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Commande supprimée avec succès !');
    }
}
