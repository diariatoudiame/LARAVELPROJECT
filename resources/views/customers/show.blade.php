@extends('layout')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-4"> <!-- Réduire davantage la largeur de la carte -->
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Customer Details</h5>
                        <a href="{{ route('customers.index') }}" class="btn btn-outline-light btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 offset-md-4">
                                <h5 class="card-text mb-3"> Firstname: {{ $customer->firstname }}</h5>
                                <h5 class="card-text mb-3"> Name: {{ $customer->name }}</h5>
                                <h5 class="card-text mb-3"> Address: {{ $customer->address }}</h5>
                                <h5 class="card-text mb-3"><i class="bi bi-envelope text-primary me-2"></i> Email: {{ $customer->email }}</h5>
                                <h5 class="card-text mb-3"><i class="bi bi-person-badge text-primary me-2"></i> Gender: {{ $customer->gender }}</h5>
                                <br> <br> <br>
                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary">
                                    <i class="bi bi-pencil me-2"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
