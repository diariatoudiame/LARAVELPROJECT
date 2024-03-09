@extends('layout')

@section('content')
    <div class="container py-3"> <!-- Modification de la classe py-5 en py-3 pour réduire l'espace vertical -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0 rounded-lg">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-lg" style="height: 70px;">
                        <h5 class="mb-0">Order Details</h5>
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-light btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h3 class="card-title mb-0">Order Products</h3>
                                </div>
                                @foreach($order->products as $product)
                                    <div class="card mb-3">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <h5 class="card-title">{{ $product->name }}</h5>
                                                <p class="card-text">Quantity: {{ $product->pivot->quantity }}</p>
                                                <p class="card-text">Price: {{ $product->price }} €</p>
                                            </div>
                                            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" class="img-fluid rounded border border-primary shadow mx-3" style="height: 100px;">
                                        </div>
                                    </div>
                                @endforeach
                                <p class="card-text mb-3 text-start"><i class="bi bi-person text-primary me-2"></i> Customer: {{ $order->customer->firstname }} {{ $order->customer->name }}</p>
                                <p class="card-text mb-3 text-start"><i class="bi bi-calendar2 text-primary me-2"></i> Order Date: {{ $order->created_at->format('d/m/Y H:i') }}</p>

                                <div class="row mb-4">
                                    <div class="col-md-6 text-end">
                                        <p class="text-muted mb-2">Total Amount:</p>
                                        <h4 class="text-primary">{{ $order->total_amount }} FCFA</h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
