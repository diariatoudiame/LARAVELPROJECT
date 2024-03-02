@extends('layout')
@section('content')
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">
            <div class="row mb-3">
                <div class="col-sm-12 col-12">
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Add New User</a>
                </div>
            </div>

            <!-- Row start -->
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Users</div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>First Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td style="width: 100px; height: 100px; vertical-align: middle;">
                                                <img src="{{ asset('storage/' . $user->photo) }}" class="media-avatar" alt="User Photo" style="max-width: 100%; max-height: 100%;" />
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->firstname }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <div class="actions">
                                                        <a href="#" class="showRow">
                                                            <i class="bi bi-eye text-primary" style="font-size: 1.2rem; vertical-align: middle;"></i> <!-- Icône pour afficher les détails -->
                                                        </a>
                                                        <a href="{{ route('users.edit', $user->id) }}" class="editRow" style="vertical-align: middle;">
                                                            <i class="bi bi-pencil text-warning" style="font-size: 1.2rem;"></i> <!-- Icône de modification -->
                                                        </a>
                                                        <form id="deleteForm{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block; vertical-align: middle;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="confirmDelete('{{ $user->id }}'); return false;" style="border: none; background: none;">
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
        function confirmDelete(userId) {
            Swal.fire({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this user!",
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

                        document.getElementById("deleteForm" + userId).submit();
                    } else {

                        Swal.fire("The user has not been deleted!", "", "info");
                    }
                });
        }
    </script>

@endsection
