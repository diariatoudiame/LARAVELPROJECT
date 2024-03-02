@extends('layout')
@section('content')

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Add Category</h5>
                </div>
                <div class="card-body">
                    <form id="categoryForm" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
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
                                                       <div class="col-sm-12 mt-3">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary" >Save</button>
                                    <a href="{{ route('categories.index') }}">
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
        document.getElementById('categoryForm').addEventListener('submit', function(event) {
            event.preventDefault();


            if(this.checkValidity()) {

                Swal.fire({
                    title: 'Confirmation',
                    text: 'Are you sure you want to save this category?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, save it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {

                        this.submit();
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire(
                            'Cancelled',
                            'Your Category is not saved :)',
                            'error'
                        )
                    }
                });
            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Please fill out all required fields correctly.'
                });
            }
        });


    </script>

@endsection
