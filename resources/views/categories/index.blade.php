@extends('layout')
@section('content')
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">
            <div class="row mb-3">
                <div class="col-sm-12 col-12">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">Add New Category</a>
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
                            <div class="card-title">Categories</div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $c)
                                        <tr>
                                            <td>{{ $c->id }}</td>
                                            <td>{{ $c->name }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <div class="actions">
                                                        <a href="#" class="showRow">
                                                            <i class="bi bi-eye text-primary" style="font-size: 1.2rem; vertical-align: middle;"></i> <!-- Icône pour afficher les détails -->
                                                        </a>
                                                        <span class="icon-space"></span> <!-- Espace entre les icônes -->
                                                        <a href="{{ route('categories.edit', $c->id) }}" class="editRow">
                                                            <i class="bi bi-pencil text-warning" style="font-size: 1.2rem; vertical-align: middle;"></i> <!-- Icône de modification -->
                                                        </a>
                                                        <span class="icon-space"></span> <!-- Espace entre les icônes -->
                                                        <form id="deleteFormC{{ $c->id }}" action="{{ route('categories.destroy', $c->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="confirmDelete('{{ $c->id }}'); return false;"  style="border: none; background: none; padding: 0; cursor: pointer;">
                                                                <i class="bi bi-trash text-danger" style="font-size: 1.2rem; vertical-align: middle;"></i> <!-- Changement de couleur -->
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

            {{ $categories->links() }}

        </div>



    </div>
    <!-- Content wrapper scroll end -->

    <style>
        .icon-space {
            margin-right: 10px; /* Espacement entre les icônes */
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Charger SweetAlert2 depuis CDN -->
    <script>
        function confirmDelete(categoryId) {
            Swal.fire({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this category!",
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

                        document.getElementById("deleteFormC" + categoryId).submit();
                    } else {

                        Swal.fire("The category has not been deleted!", "", "info");
                    }
                });
        }
    </script>

@endsection
