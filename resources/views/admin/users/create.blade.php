<!-- resources/views/admin/users/create.blade.php -->
@extends('a_components.layout')

@section('content')
<div class="container mt-5">
    <div class="card">
        
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1 class="mb-0">Create User</h1>
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
        </div>
        <div class="card-body">
            @if(session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="role_id" class="form-label">Role</label>
                    <select class="form-control" id="role_id" name="role_id" required>
                        <option value="" disabled selected>=== Pilih Role ===</option>
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                    </select>
                    @error('role_id')
                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn btn-success">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection
