@extends('layout')
@section('content')
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">
            <div class="row mb-3">
                <div class="col-sm-4 col-12 d-flex justify-content-between"> <!-- Modifier la classe col-sm-12 en col-sm-6 -->
                    <a href="{{ route('customers.create') }}" class="btn btn-primary">Add New Customer</a>
                    <div class="position-relative">
                        <a href="{{ route('products.export') }}" class="btn btn-primary mr-2" style="margin-right: 5px;"><i class="icon-export"></i> Export</a>
                        <div id="loading" class="spinner-border text-primary d-none spinner-border-sm" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span id="loading-text" class="ml-1 d-none" style="position: absolute; top: 0; right: -80px;">Please wait...</span> <!-- Ajuster le positionnement du texte -->
                    </div>
                </div>
            </div>


            <!-- Row start -->
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Products</div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Quantity in Stock</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->quantity_in_stock }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <div class="actions">
                                                        <a href="{{ route('products.show', $product->id) }}" class="showRow">
                                                            <i class="bi bi-eye text-primary" style="font-size: 1.2rem; vertical-align: middle;"></i>
                                                        </a>
                                                        <a href="{{ route('products.edit', $product->id) }}" class="editRow" style="vertical-align: middle;">
                                                            <i class="bi bi-pencil text-warning" style="font-size: 1.2rem;"></i>
                                                        </a>
                                                        <form id="deleteForm{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block; vertical-align: middle;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="confirmDelete('{{ $product->id }}'); return false;" style="border: none; background: none;">
                                                                <i class="bi bi-trash text-danger" style="font-size: 1.2rem;"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

        </div>
        <!-- Content wrapper end -->

        <!-- App Footer start -->
        <div class="app-footer">
            <span>© Bootstrap Gallery 2023</span>
        </div>
        <!-- App footer end -->

    </div>
    <!-- Content wrapper scroll end -->

    <style>
        .icon-space {
            margin-right: 15px; /* Espacement entre les icônes */
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Charger SweetAlert2 depuis CDN -->
    <script>
        function confirmDelete(productId) {
            Swal.fire({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this product!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it",
                cancelButtonText: "No, cancel",
                buttonsStyling: false,
                customClass: {
                    confirmButton: "btn btn-danger mr-2",
                    cancelButton: "btn btn-secondary"
                }
            })
                .then((willDelete) => {
                    if (willDelete.isConfirmed) {

                        document.getElementById("deleteForm" + productId).submit();
                    } else {

                        Swal.fire("The product has not been deleted!", "", "info");
                    }
                });
        }

        document.addEventListener("DOMContentLoaded", function() {
            const exportBtn = document.querySelector('.btn.btn-primary.mr-2');
            const loading = document.getElementById('loading');
            const loadingText = document.getElementById('loading-text');

            exportBtn.addEventListener('click', function() {
                loading.classList.remove('d-none');
                loadingText.classList.remove('d-none');

                setTimeout(function() {
                    loading.classList.add('d-none');
                    loadingText.classList.add('d-none');
                }, 2000); // Temps simulé pour le chargement. Remplacez-le par la logique de téléchargement réelle.
            });
        });
    </script>

@endsection
