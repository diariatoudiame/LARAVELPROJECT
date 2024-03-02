@extends('layout')
@section('content')

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Edit Category</h5>
                </div>
                <div class="card-body">
                    <form id="userForm" action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Utiliser la méthode PUT pour la mise à jour -->
                        <div class="row gutters">
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="inputName">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter a name" value="{{ $category->name }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12 mt-3">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->

@endsection
