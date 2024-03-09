@extends('layout')

@section('content')
    <!-- Row start -->
    <div class="row gutters">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Edit Order</h5>
                </div>
                <div class="card-body">
                    <form id="orderForm" action="{{ route('orders.update', $order->id) }}" method="POST" onsubmit="return confirmUpdateOrder()">
                        @csrf
                        @method('PUT') <!-- Utiliser la méthode PUT pour la mise à jour -->
                        <div class="row gutters">
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label for="reference">Reference</label>
                                    <input type="text" class="form-control" id="reference" name="reference" value="{{ $order->reference }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label for="order_date">Order Date</label>
                                    <input type="date" class="form-control" id="order_date" name="order_date" value="{{ $order->order_date }}">
                                </div>
                            </div>

                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label for="customer_id">Customer</label>
                                    <select class="form-control @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id">
                                        <option value="">Select Customer</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}" @if($customer->id == $order->customer_id) selected @endif>{{ $customer->firstname }} {{ $customer->name }}</option>
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

                        <!-- Afficher les produits existants dans la commande -->
                        <div class="row gutters">
                            @foreach ($order->products as $orderProduct)
                                <div class="row gutters product">
                                    <div class="col-sm-3 col-12">
                                        <div class="form-group">
                                            <label for="product_id">Product</label>
                                            <input type="text" class="form-control" value="{{ $orderProduct->name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-12">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="text" class="form-control" value="{{ $orderProduct->price }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm -2 col-12">
                                        <div class="form-group">
                                            <label for="quantity-in-stock">Quantity in Stock</label>
                                            <input type="text" class="form-control" value="{{ $orderProduct->quantity_in_stock }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-12">
                                        <div class="form-group">
                                            <label for="quantity-to-order">Quantity to Order</label>
                                            <input type="number" class="form-control" value="{{ $orderProduct->pivot->quantity }}" min="1" name="quantity[]">
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <!-- Champ pour ajouter un nouveau produit -->
                        <div class="row gutters product">
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
                        </div>
                        <div class="row gutters" id="newProductFields"></div>
                        <div class="row gutters">
                            <div class="col-sm-12 mt-3">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
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
        function confirmUpdateOrder() {
            return Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure you want to update this order?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, update it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    return true;
                } else {
                    return false;
                }
            });
        }

        // Update price, quantity in stock, and max quantity to order when product selected
        document.getElementById('product_id').addEventListener('change', function() {
            var price = this.options[this.selectedIndex].getAttribute('data-price');
            var quantityInStock = this.options[this.selectedIndex].getAttribute('data-quantity-in-stock');
            document.getElementById('price').value = price;
            document.getElementById('price_hidden').value = price;
            document.getElementById('quantity-in-stock').value = quantityInStock;
            document.getElementById('quantity-in-stock_hidden').value = quantityInStock;
            document.getElementById('quantity').setAttribute('max', quantityInStock);
        });
    </script>
@endsection
