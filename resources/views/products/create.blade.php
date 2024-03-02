@extends('layout')
@section('content')

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Add Product</h5>
                </div>
                <div class="card-body">
                    <form id="productForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateProductForm()">
                        @csrf
                        <div class="row gutters">
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter product name">
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
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Enter product description"></textarea>
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
                                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Enter product price">
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
                                    <input type="number" class="form-control @error('quantity_in_stock') is-invalid @enderror" id="quantity_in_stock" name="quantity_in_stock" placeholder="Enter quantity in stock">
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
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        <img src="#" id="selectedPhoto" alt="Selected Photo" style="max-width: 100%; max-height: 100px;">
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
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('products.index') }}">
                                    <button type="button" class="btn btn-secondary">Cancel</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function validateProductForm() {
            var name = document.getElementById('name').value;
            var description = document.getElementById('description').value;
            var price = document.getElementById('price').value;
            var quantity_in_stock = document.getElementById('quantity_in_stock').value;
            var photo = document.getElementById('photo').value;
            var category_id = document.getElementById('category_id').value;

            if (name.trim() === "" || description.trim() === "" || price.trim() === "" || quantity_in_stock.trim() === "" || photo.trim() === "" ||  category_id.trim() === "") {
                displaySweetAlert("Error", "All fields are required", "error");
                return false;
            }

            if (!/^[a-zA-Z ]+$/.test(name)) {
                displaySweetAlert("Error", "The name can only contain letters and spaces", "error");
                return false;
            }




            // Ajoutez d'autres validations selon vos besoins

            return true;
        }

        function displaySweetAlert(title, message, icon) {
            Swal.fire({
                title: title,
                text: message,
                icon: icon,
                confirmButtonText: "OK"
            });
        }

        function previewPhoto(event) {
            const preview = document.getElementById('selectedPhoto');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }
    </script>

@endsection
