@extends('layout')
@section('content')

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Edit Product</h5>
                </div>
                <div class="card-body">
                    <form id="productForm" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Utiliser la méthode PUT pour la mise à jour -->
                        <div class="row gutters">
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter product name" value="{{ $product->name }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Enter product description">{{ $product->description }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Enter product price" value="{{ $product->price }}">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="quantity_in_stock">Quantity in Stock</label>
                                    <input type="number" class="form-control @error('quantity_in_stock') is-invalid @enderror" id="quantity_in_stock" name="quantity_in_stock" placeholder="Enter quantity in stock" value="{{ $product->quantity_in_stock }}">
                                    @error('quantity_in_stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                        <option value="" disabled selected>Choose a Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @if($category->id == $product->category_id) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <div class="border p-2" id="photoPreview" style="max-width: 100px;">
                                        <img src="{{ asset('storage/' . $product->photo) }}" id="selectedPhoto" alt="Selected Photo" style="max-width: 100%; max-height: 100px;">
                                    </div>
                                    <input type="file" class="form-control mt-2 @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*" onchange="previewPhoto(event)">
                                    @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 mt-3">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->

@endsection
