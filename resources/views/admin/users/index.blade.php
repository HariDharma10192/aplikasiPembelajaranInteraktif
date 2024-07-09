<!-- resources/views/admin/users/index.blade.php -->
@extends('a_components.layout')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1>Daftar Pengguna</h1>
                <a href="{{ route('admin.users.create') }}" class="btn btn-success">Tambah Pengguna</a>
            </div>
            <div class="card-body">
                <!-- Form pencarian -->
                <form method="GET" action="{{ route('admin.users.index') }}" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama atau email" value="{{ request()->search }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>

                @if(session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                {{-- TABLE START --}}
                {{-- 1. ADD scrool behaviour in mobile view --}}
                  <!-- Wrapper for table to make it scrollable on mobile -->
                  <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role_id == 1 ? 'Admin' : 'User' }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- TABLE END --}}
                <!-- Pagination links -->
                <div class="mt-3">
                    {{ $users->links() }}
                </div>

                <a href="/" class="btn btn-sm btn-secondary mb-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
