@extends('layout')
@section('content')
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">
            <div class="row mb-3">
                <div class="col-sm-12 col-12">
                    <a href="{{ route('customers.create') }}" class="btn btn-primary">Add New Customer</a>
                </div>
            </div>

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
                                                    <a href="#" class="showRow">
                                                        <i class="bi bi-eye text-primary" style="font-size: 1.2rem; "></i> <!-- Icône pour afficher les détails -->
                                                    </a>
                                                    <span class="icon-space"></span> <!-- Espace entre les icônes -->
                                                    <a href="{{ route('customers.edit', $customer->id) }}" class="editRow">
                                                        <i class="bi bi-pencil text-warning" style="font-size: 1.2rem; "></i> <!-- Icône de modification -->
                                                    </a>
                                                    <span class="icon-space"></span> <!-- Espace entre les icônes -->
                                                    <form id="deleteForm{{ $customer->id }}" action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="confirmDelete('{{ $customer->id }}'); return false;"  style="border: none; background: none; padding: 0; cursor: pointer;">
                                                            <i class="bi bi-trash text-danger" style="font-size: 1.2rem; "></i> <!-- Changement de couleur -->
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
            margin-right: 10px; /* Espacement entre les icônes */
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Charger SweetAlert2 depuis CDN -->
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
    </script>

@endsection
