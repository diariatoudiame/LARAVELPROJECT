@extends('layout')
@section('content')

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Add User</h5>
                </div>
                <div class="card-body">
                    <form id="userForm" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row gutters">
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="inputName">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter a name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="inputEmail">Firstname</label>
                                    <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" placeholder="Enter firstname">
                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="inputPassword">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="role_id">Role</label>
                                    <select class="form-control @error('role_id') is-invalid @enderror" id="role_id" name="role_id">
                                        <option value="" disabled selected>Choose a Role</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="inputPhoto">Photo</label>
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
                                    <button type="submit" class="btn btn-primary" >Save</button>
                                    <a href="{{ route('users.index') }}">
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
        document.getElementById('userForm').addEventListener('submit', function(event) {
            // Empêche la soumission du formulaire par défaut
            event.preventDefault();

            // Vérifie si le formulaire est valide
            if(this.checkValidity()) {
                // Affiche la boîte de dialogue de confirmation
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Are you sure you want to save this user?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, save it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si l'utilisateur confirme, soumet le formulaire
                        this.submit();
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire(
                            'Cancelled',
                            'Your user is not saved :)',
                            'error'
                        )
                    }
                });
            } else {
                // Affiche un message d'erreur si la validation échoue
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Please fill out all required fields correctly.'
                });
            }
        });

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
