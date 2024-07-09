@extends('a_components.layout')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1>Evaluasi Kuis</h1>
                <a href="{{ route('admin.quis.create') }}" class="btn btn-success">Tambah Kuis</a>
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
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>

                <table class="table table-bordered table-responsive">
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
                                    <a href="{{ route('admin.quis.evaluasi.detail', $materi->id) }}" class="btn btn-primary">Show Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="/" class="btn btn-sm btn-secondary mb-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
