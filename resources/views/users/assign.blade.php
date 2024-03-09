@extends('layout')
@section('content')

    <!-- User Details Section -->

    <!-- Assign Role Form (Hidden Initially) -->

        <form id="assignRoleForm" action="{{ route('users.assignRole', $user) }}" method="POST">
            @csrf
            <!-- Role Selection -->
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

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Assign Role</button>
        </form>
    </div>

    <!-- JavaScript to Show/Hide Form -->


@endsection
