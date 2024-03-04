@extends('layout')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0 rounded-lg">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-lg" style="height: 70px;"> <!-- Ajout de la hauteur et de la couleur -->
                        <h5 class="mb-0">Détails du produit</h5>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-light btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Retour
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center mb-4">
                                @isset($product->photo)
                                    <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" class="img-fluid rounded border border-primary shadow" style="max-width: 200px; height: 250px;"> <!-- Augmentation de la hauteur -->
                                @else
                                    <div class="text-muted">Photo non disponible</div>
                                @endisset
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h3 class="card-title mb-0">{{ $product->name }}</h3>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-lg">
                                        <i class="bi bi-pencil me-2"></i> Modifier
                                    </a>
                                </div>
                                <p class="card-text mb-3 text-start"><i class="bi bi-tags text-primary me-2"></i> Catégorie : {{ $product->category->name }}</p>
                                <p class="card-text mb-4 text-start"><i class="bi bi-info-circle text-primary me-2"></i> {{ $product->description }}</p>
                                <div class="row mb-4">
                                    <div class="col-md-6 text-end">
                                        <p class="text-muted mb-2">Prix :</p>
                                        <h4 class="text-primary">{{ number_format($product->price, 2, ',', ' ') }} €</h4>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <p class="text-muted mb-2">Quantité en stock :</p>
                                        <h4 class="text-success">{{ $product->quantity_in_stock }}</h4>
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
