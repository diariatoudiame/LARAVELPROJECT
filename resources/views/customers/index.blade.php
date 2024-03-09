@extends('layout')
@section('content')
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">
        <!-- Content wrapper start -->
        <div class="content-wrapper">
            <div class="row mb-3">
                <div class="col-sm-4 col-12 d-flex justify-content-between">
                    <a href="{{ route('customers.create') }}" class="btn btn-primary">Add New Customer</a>
                    <div class="position-relative">
                        <a href="{{ route('exportPDF') }}" class="btn btn-primary mr-2" style="margin-right: 5px;"><i class="icon-export"></i> Export</a>
                        <div id="loading" class="spinner-border text-primary d-none spinner-border-sm" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span id="loading-text" class="ml-1 d-none" style="position: absolute; top: 0; right: -80px;">Please wait...</span>
                    </div>
                </div>
            </div>

            <!-- Afficher les messages de succès -->
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            <!-- Afficher les messages d'erreur -->
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif

            <!-- Row start -->
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Customers</div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Firstname</th>
                                        <th>Address</th>
                                        <th>Phone Number</th>
                                        <th>Gender</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->id }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->firstname }}</td>
                                            <td>{{ $customer->address }}</td>
                                            <td>{{ $customer->phone_number }}</td>
                                            <td>{{ $customer->gender }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <div class="actions">
                                                        <a href="{{ route('customers.show', $customer->id) }}" class="showRow">
                                                            <i class="bi bi-eye text-primary" style="font-size: 1.2rem; vertical-align: middle;"></i> <!-- Icône pour afficher les détails -->
                                                        </a>
                                                        <a href="{{ route('customers.edit', $customer->id) }}" class="editRow" style="vertical-align: middle;">
                                                            <i class="bi bi-pencil text-warning" style="font-size: 1.2rem;"></i> <!-- Icône de modification -->
                                                        </a>
                                                        @if(Auth::user()->hasRole('admin'))
                                                        <a href="{{ route('customers.history', $customer->id) }} " class="editRow" style="vertical-align: middle;">
                                                            <i class="bi bi-clock-history text-info icon-space" style="font-size: 1.2rem;"></i> <!-- Icône d'historique -->
                                                        </a>
                                                        @endif
                                                        <form id="deleteForm{{ $customer->id }}" action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display: inline-block; vertical-align: middle;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="confirmDelete('{{ $customer->id }}'); return false;" style="border: none; background: none;">
                                                                <i class="bi bi-trash text-danger" style="font-size: 1.2rem;"></i> <!-- Changement de couleur -->
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
        <div class="row">
            {{ $customers->links() }}
        </div>

    </div>
    <!-- Content wrapper scroll end -->

    <style>
        .icon-space {
            margin-right: 10px;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(customerId) {
            Swal.fire({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this customer!",
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
                        document.getElementById("deleteForm" + customerId).submit();
                    } else {
                        Swal.fire("The customer has not been deleted!", "", "info");
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
                }, 2000);
            });
        });
    </script>

@endsection
