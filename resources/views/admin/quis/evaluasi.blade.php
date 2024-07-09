@extends('a_components.layout')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h1 class="mb-2 mb-md-0">Evaluasi Kuis</h1>
                <a href="{{ route('admin.quis.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Tambah Kuis
                </a>
            </div>
            <div class="card-body">
                @if(session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form method="GET" action="{{ route('admin.quis.evaluasi') }}" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan judul" value="{{ request()->search }}">
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Judul Materi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($materis as $materi)
                                <tr>
                                    <td>{{ $materi->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $materi->judul }}</td>
                                    <td>
                                        <a href="{{ route('admin.quis.evaluasi.detail', $materi->id) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
                    <div class="mb-2 mb-md-0">
                        <a href="/" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                    <div>
                        {{ $materis->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection