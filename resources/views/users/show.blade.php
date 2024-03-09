@extends('layout')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">User Details</h5>
                        <a href="{{ route('users.index') }}" class="btn btn-outline-light btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center mb-4">
                                <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="img-fluid rounded-circle border border-brown" style="max-width: 150px;">
                            </div>
                            <div class="col-md-8">
                                <h5 class="card-text mb-3"> Firstname: {{ $user->firstname }}</h5>
                                <h5 class="card-text mb-3"> Name: {{ $user->name }}</h5>
                                @if ($user->email)
                                    <h5 class="card-text mb-3"><i class="bi bi-envelope text-primary me-2"></i> Email: {{ $user->email }}</h5>
                                @endif
                                @foreach($user->roles as $r)
                                    <h5 class="card-text mb-2"><i class="bi bi-person-badge text-primary me-2"></i> Role: {{ $r->name }}</h5>
                                @endforeach
                                <br> <br> <br>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">
                                    <i class="bi bi-pencil me-2"></i> Edit
                                </a>

                                <a href="{{ route('assign', $user->id) }}" class="btn btn-primary">
                                     Assign a Role
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
