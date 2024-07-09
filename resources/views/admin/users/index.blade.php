<!-- resources/views/admin/users/index.blade.php -->
@extends('a_components.layout')

@section('content')
<style>
    .action-buttons {
        display: flex;
        gap: 5px;
        justify-content: flex-start;
    }
    .action-buttons .btn {
        flex: 0 1 auto;
        min-width: 60px;
    }
    .action-buttons form {
        flex: 0 1 auto;
        margin: 0;
    }
    @media (max-width: 768px) {
        .action-buttons {
            flex-direction: column;
        }
        .action-buttons .btn,
        .action-buttons form {
            width: 100%;
        }
    }
</style>

<div class="container-fluid mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
            <h1 class="mb-2 mb-md-0">Daftar Pengguna</h1>
            <a href="{{ route('admin.users.create') }}" class="btn btn-success">
                <i class="fas fa-user-plus"></i> Tambah Pengguna
            </a>
        </div>
        <div class="card-body">
            <!-- Form pencarian -->
            <form method="GET" action="{{ route('admin.users.index') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama atau email" value="{{ request()->search }}">
                    <button class="btn btn-success" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>

            @if(session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
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
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
                <div class="mb-2 mb-md-0">
                    <a href="/" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div>
                    {{ $users->links() }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection