@extends('u_components.layout')  

@section('content')    

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6">
            <div class="card bg-success">
                <div class="card-body">
                    <form action="/register" method="POST" class="w-100 d-flex flex-column">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            @error('password')
                                <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            @error('password_confirmation')
                                <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="/login" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection