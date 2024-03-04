@extends('layout')

@section('content')
    <!-- Row start -->
    <div class="row gutters">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Add Order</h5>
                </div>
                <div class="card-body">
                    <form id="orderForm" action="{{ route('orders.store') }}" method="POST" onsubmit="return validateOrderForm()">
                        @csrf
                        <div class="row gutters">
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label for="reference">Reference</label>
                                    <input type="text" class="form-control" id="reference" name="reference" value="{{ 'CMD-' . uniqid() }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label for="order_date">Order Date</label>
                                    <input type="date" class="form-control" id="order_date" name="order_date" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="in progress" selected>In Progress</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label for="customer_id">Customer</label>
                                    <select class="form-control @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id">
                                        <option value="">Select Customer</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->firstname }} {{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div id="productFields">
                            <div class="row gutters mb-3">
                                <div class="col-sm-3 col-12">
                                    <div class="form-group">
                                        <label for="product_id">Product</label>
                                        <select class="form-control @error('product_id') is-invalid @enderror" id="product_id" name="product_id[]">
                                            <option value="">Select Product</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-quantity-in-stock="{{ $product->quantity_in_stock }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-2 col-12">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" class="form-control" id="price" name="price[]" readonly>
                                        <input type="hidden" id="price_hidden" name="price_hidden" value="">
                                    </div>
                                </div>
                                <div class="col-sm-2 col-12">
                                    <div class="form-group">
                                        <label for="quantity-in-stock">Quantity in Stock</label>
                                        <input type="text" class="form-control" id="quantity-in-stock" name="quantity_in_stock[]" readonly>
                                        <input type="hidden" id="quantity-in-stock_hidden" name="quantity_in_stock_hidden" value="">
                                    </div>
                                </div>
                                <div class="col-sm-2 col-12">
                                    <div class="form-group">
                                        <label for="quantity-to-order">Quantity to Order</label>
                                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity[]" min="1">
                                        @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-1 col-12">
                                    <button type="button" class="btn btn-danger btn-sm mt-4 remove-product-field">Remove</button>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-primary" id="addProductButton">Add Product</button>
                            </div>
                        </div>
                        <div class="row gutters mt-3">
                            <div class="col-sm-12">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('orders.index') }}">
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
        function validateOrderForm() {
            var customer_id = document.getElementById('customer_id').value;
            var product_ids = document.querySelectorAll('select[name="product_id[]"]');
            var quantitiesToOrder = document.querySelectorAll('input[name="quantity[]"]');
            var quantitiesInStock = document.querySelectorAll('input[name="quantity_in_stock_hidden"]');

            if (customer_id.trim() === "") {
                displaySweetAlert("Error", "Customer is required", "error");
                return false;
            }

            var hasProduct = false;
            for (var i = 0; i < product_ids.length; i++) {
                if (product_ids[i].value.trim() !== "") {
                    hasProduct = true;
                    if (parseInt(quantitiesToOrder[i].value) > parseInt(quantitiesInStock[i].value)) {
                        displaySweetAlert("Error", "Quantity to order exceeds the available stock for product " + product_ids[i].options[product_ids[i].selectedIndex].text, "error");
                        return false;
                    }
                }
            }

            if (!hasProduct) {
                displaySweetAlert("Error", "At least one product is required", "error");
                return false;
            }

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

        document.getElementById('addProductButton').addEventListener('click', function() {
            var productFields = document.getElementById('productFields');
            var newProductField = document.createElement('div');
            newProductField.classList.add('row', 'gutters', 'mb-3');

            newProductField.innerHTML = `
                <div class="col-sm-3 col-12">
                    <div class="form-group">
                        <label for="product_id">Product</label>
                        <select class="form-control @error('product_id') is-invalid @enderror" id="product_id" name="product_id[]">
                            <option value="">Select Product</option>
                            @foreach($products as $product)
            <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-quantity-in-stock="{{ $product->quantity_in_stock }}">{{ $product->name }}</option>
                            @endforeach
            </select>
@error('product_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                        </span>
                        @enderror
            </div>
        </div>
        <div class="col-sm-2 col-12">
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price[]" readonly>
                <input type="hidden" id="price_hidden" name="price_hidden" value="">
            </div>
        </div>
        <div class="col-sm-2 col-12">
            <div class="form-group">
                <label for="quantity-in-stock">Quantity in Stock</label>
                <input type="text" class="form-control" id="quantity-in-stock" name="quantity_in_stock[]" readonly>
                <input type="hidden" id="quantity-in-stock_hidden" name="quantity_in_stock_hidden" value="">
            </div>
        </div>
        <div class="col-sm-2 col-12">
            <div class="form-group">
                <label for="quantity-to-order">Quantity to Order</label>
                <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity[]" min="1">
                        @error('quantity')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                        </span>
                        @enderror
            </div>
        </div>
        <div class="col-sm-1 col-12">
            <button type="button" class="btn btn-danger btn-sm mt-4 remove-product-field">Remove</button>
        </div>
`;

            productFields.appendChild(newProductField);

            // Update price, quantity in stock, and max quantity to order when product selected
            newProductField.querySelector('select[name="product_id[]"]').addEventListener('change', function() {
                var price = this.options[this.selectedIndex].getAttribute('data-price');
                var quantityInStock = this.options[this.selectedIndex].getAttribute('data-quantity-in-stock');
                newProductField.querySelector('#price').value = price;
                newProductField.querySelector('#price_hidden').value = price;
                newProductField.querySelector('#quantity-in-stock').value = quantityInStock;
                newProductField.querySelector('#quantity-in-stock_hidden').value = quantityInStock;
                newProductField.querySelector('#quantity').setAttribute('max', quantityInStock);
            });
        });

        // Update price, quantity in stock, and max quantity to order for the first product field
        document.querySelector('select[name="product_id[]"]').addEventListener('change', function() {
            var price = this.options[this.selectedIndex].getAttribute('data-price');
            var quantityInStock = this.options[this.selectedIndex].getAttribute('data-quantity-in-stock');
            document.getElementById('price').value = price;
            document.getElementById('price_hidden').value = price;
            document.getElementById('quantity-in-stock').value = quantityInStock;
            document.getElementById('quantity-in-stock_hidden').value = quantityInStock;
            document.getElementById('quantity').setAttribute('max', quantityInStock);
        });

        // Gestion de la suppression des champs de produit avec la délégation d'événements
        document.getElementById('productFields').addEventListener('click', function(event) {
            if (event.target.matches('.remove-product-field')) {
                event.target.closest('.row.gutters.mb-3').remove();
            }
        });
    </script>
@endsection
