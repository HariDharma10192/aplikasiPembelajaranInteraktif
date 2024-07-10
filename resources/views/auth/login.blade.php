@extends('u_components.layout')  

@section('content')
  <div class="d-flex justify-content-end mt-5 mb-3">
        <a href="/register" class="btn btn-primary text-end">
            <i class="fas fa-user-plus"></i> Registrasi
        </a>
    </div>
    {{-- display the form on the central of the page using boostrap classes --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="card bg-success">
                    <div class="card-body">       
                        <form action="/login" method="POST" class="w-100 mx-auto d-flex flex-column">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i> Email
                                </label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email">
                                @error('email')
                                <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock"></i> Password
                                </label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
                                @error('password')
                                <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

@endsection

