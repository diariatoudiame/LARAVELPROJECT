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
                        <div class="row gutters">
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label for="product_id">Product</label>
                                    <select class="form-control @error('product_id') is-invalid @enderror" id="product_id" name="product_id">
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
                                    <input type="text" class="form-control" id="price" name="price" readonly>
                                </div>
                            </div>
                            <div class="col-sm-2 col-12">
                                <div class="form-group">
                                    <label for="quantity-in-stock">Quantity in Stock</label>
                                    <input type="text" class="form-control" id="quantity-in-stock" name="quantity_in_stock" readonly>
                                </div>
                            </div>
                            <div class="col-sm-2 col-12">
                                <div class="form-group">
                                    <label for="quantity-to-order">Quantity to Order</label>
                                    <input type="number" class="form-control @error('quantity_to_order') is-invalid @enderror" id="quantity-to-order" name="quantity_to_order" min="1">
                                    @error('quantity_to_order')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row gutters" id="newProductFields"></div>
                        <div class="row gutters">
                            <div class="col-sm-12 mt-3">
                                <div class="text-right">
                                    <button type="button" class="btn btn-success" id="addNewProductBtn">Add New Product</button>
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
            var product_id = document.getElementById('product_id').value;
            var quantityToOrder = document.getElementById('quantity-to-order').value;
            var quantityInStock = document.getElementById('quantity-in-stock').innerText;

            if (customer_id.trim() === "" || product_id.trim() === "" || quantityToOrder.trim() === "") {
                displaySweetAlert("Error", "All fields are required", "error");
                return false;
            }

            if (parseInt(quantityToOrder) > parseInt(quantityInStock)) {
                displaySweetAlert("Error", "Quantity to order exceeds the available stock", "error");
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

        // Update price, quantity in stock, and max quantity to order when product selected
        document.getElementById('product_id').addEventListener('change', function() {
            var price = this.options[this.selectedIndex].getAttribute('data-price');
            var quantityInStock = this.options[this.selectedIndex].getAttribute('data-quantity-in-stock');
            document.getElementById('price').value = price;
            document.getElementById('quantity-in-stock').value = quantityInStock;
            document.getElementById('quantity-to-order').setAttribute('max', quantityInStock);
        });

        // Add New Product button functionality
        document.getElementById('addNewProductBtn').addEventListener('click', function() {
            var productForm = `
                <div class="col-sm-3 col-12">
                    <div class="form-group">
                        <label for="new_product_name">Product Name</label>
                        <select class="form-control" id="new_product_name_${Date.now()}" name="new_product_name">
                            <option value="">Select Product</option>
                            @foreach($products as $product)
            <option value="{{ $product->name }}" data-price="{{ $product->price }}" data-quantity-in-stock="{{ $product->quantity_in_stock }}">{{ $product->name }}</option>
                            @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-2 col-12">
        <div class="form-group">
            <label for="new_product_price">Price</label>
            <input type="text" class="form-control" id="new_product_price_${Date.now()}" name="new_product_price" readonly>
                    </div>
                </div>
                <div class="col-sm-2 col-12">
                    <div class="form-group">
                        <label for="new_product_quantity_in_stock">Quantity in Stock</label>
                        <input type="text" class="form-control" id="new_product_quantity_in_stock_${Date.now()}" name="new_product_quantity_in_stock" readonly>
                    </div>
                </div>
                <div class="col-sm-2 col-12">
                    <div class="form-group">
                        <label for="new_product_quantity_to_order">Quantity to Order</label>
                        <input type="number" class="form-control" id="new_product_quantity_to_order_${Date.now()}" name="new_product_quantity_to_order" min="1">
                    </div>
                </div>
            `;
            document.getElementById('newProductFields').insertAdjacentHTML('beforeend', productForm);
        });

        // Update new product price and quantity in stock based on selected product
        document.getElementById('orderForm').addEventListener('change', function(event) {
            if (event.target && event.target.id && event.target.id.startsWith('new_product_name_')) {
                var selectedProduct = event.target.value;
                var productOptions = event.target.getElementsByTagName('option');
                for (var i = 0; i < productOptions.length; i++) {
                    if (productOptions[i].value === selectedProduct) {
                        var price = productOptions[i].getAttribute('data-price');
                        var quantityInStock = productOptions[i].getAttribute('data-quantity-in-stock');
                        document.getElementById('new_product_price_' + event.target.id.split('_')[3]).value = price;
                        document.getElementById('new_product_quantity_in_stock_' + event.target.id.split('_')[3]).value = quantityInStock;
                        document.getElementById('new_product_quantity_to_order_' + event.target.id.split('_')[3]).setAttribute('max', quantityInStock);
                        break;
                    }
                }
            }
        });

        document.getElementById('quantity-to-order').addEventListener('change', function() {
            var initialQuantityInStock = document.getElementById('quantity-in-stock').value;
            var quantityOrdered = this.value;

            if (isNaN(quantityOrdered)) {
                displaySweetAlert("Error", "Please enter a valid quantity", "error");
                return;
            }

            var newQuantityInStock = initialQuantityInStock - quantityOrdered;
            document.getElementById('quantity-in-stock').value = newQuantityInStock;
        });
    </script>
@endsection
