<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Form data validation
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'product_id' => 'required|array|min:1',
            'product_id.*' => 'exists:products,id',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer|min:1',
        ]);

        // Creating the order
        $order = new Order();
        $order->customer_id = $request->customer_id;
        $order->reference = $request->reference;
        if(Auth::check()){
            $order->user_id = Auth::user()->id;
        }
        $order->order_date = $request->order_date;
        $order->total_amount = 0;

        // Saving the order
        $order->save();

        $totalAmount = 0;

        foreach ($request->product_id as $key => $productId) {
            $product = Product::find($productId);
            $quantityToOrder = $request->quantity[$key];

            if ($quantityToOrder > $product->quantity_in_stock) {
                return redirect()->back()->with('error', 'The ordered quantity exceeds the available stock for product: ' . $product->name);
            }

            $productAmount = $product->price * $quantityToOrder;
            $totalAmount += $productAmount;

            // Attaching the product to the order with details
            $order->products()->attach($product->id, [
                'quantity' => $quantityToOrder,
                'unit_price' => $product->price,
                'total_price' => $productAmount,
            ]);


            $product->quantity_in_stock -= $quantityToOrder;
            $product->save();
        }


        $order->total_amount = $totalAmount;
        $order->save();

        // Redirecting to the orders page with a success message
        return redirect()->route('orders.index')->with('success', 'Order created successfully!');
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
            'order_date' => 'required|date',
            'product_id' => 'required|array|min:1',
            'product_id.*' => 'exists:products,id',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer|min:1',
        ]);

        $totalAmount = 0; // Initialize the variable for total amount

        // Retrieving the ID of the authenticated user
        $userId = Auth::id();
        $order->reference = $request->reference;
        $order->customer_id = $request->customer_id;
        $order->order_date = $request->order_date;
        $order->save();

        // Prepare data for synchronization
        $syncData = [];
        foreach ($request->product_id as $key => $productId) {
            $product = Product::find($productId);
            $quantityToOrder = $request->quantity[$key];

            // Check product stock availability
            if ($quantityToOrder > $product->quantity_in_stock) {
                return redirect()->back()->with('error', 'The ordered quantity exceeds the available stock for the product: ' . $product->name);
            }

            $productAmount = $product->price * $quantityToOrder;
            $totalAmount += $productAmount;

            $syncData[$productId] = [
                'quantity' => $quantityToOrder,
                'unit_price' => $product->price,
                'total_price' => $productAmount,
            ];

            // Reduce product stock quantity
            $product->quantity_in_stock -= $quantityToOrder;
            $product->save();
        }

        // Synchronize products attached to the order with the new data
        $order->products()->sync($syncData);
        $order->total_amount = $totalAmount;
        $order->user_id = $userId; // Assigning the ID of the authenticated user
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
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

        return redirect()->route('orders.index')->with('success', 'Order deleted Successfully!');
    }

    public function showCustomerOrders($customerId)
    {
        $customer = Customer::find($customerId);
        $orders = $customer->orders;

        return view('orders.customer_orders', compact('customer', 'orders'));
    }
}
