@extends('layout')

@section('content')

    <div class="container py-4">
        <h4 class="mb-4">Order History for {{ $customer->firstname }} {{ $customer->name }}</h4>

        <!-- Customer Information -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title mb-0">Customer Information</h4>
            </div>
            <div class="card-body">
                <p><strong>Full Name:</strong> {{ $customer->firstname }} {{ $customer->name }}</p>
                <p><strong>Address:</strong> {{ $customer->address }}</p>
                <p><strong>Phone Number:</strong> {{ $customer->phone_number }}</p>
                <p><strong>Gender:</strong> {{ $customer->gender }}</p>
            </div>
        </div>

        <!-- Order History -->
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="card-title mb-0">Order History</h4>
            </div>
            <div class="card-body">
                @forelse ($orders as $order)
                    <div class="mb-3 border-bottom pb-3">
                        <p><strong>Order ID:</strong> {{ $order->id }}</p>
                        <p><strong>Date:</strong> {{ $order->created_at->format('Y-m-d') }}</p>
                        <p><strong>User:</strong> {{ $order->user->firstname }} {{ $order->user->name }}</p>
                        <p><strong>Total Amount:</strong> {{ $order->total_amount }} FCFA</p>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-success">View Details</a>
                    </div>
                @empty
                    <p class="text-muted">No orders found.</p>
                @endforelse
            </div>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>

@endsection
