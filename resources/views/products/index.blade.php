@extends('layout')
@section('content')

    <!-- Row start -->
    <div class="row gutters">
        @foreach($products as $product)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">
                            <small class="text-muted">Price: ${{ $product->price }}</small>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Row end -->
@endsection
