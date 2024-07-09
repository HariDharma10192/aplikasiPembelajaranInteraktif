@extends('u_components.layout')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>Daftar Kuis</h1>
            </div>
            <div class="card-body">
                @if(session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- Form pencarian -->
                <form method="GET" action="{{ route('users.quis.index') }}" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan judul" value="{{ request()->search }}">
                        <button class="btn btn-success" type="submit">Cari</button>
                    </div>
                </form>
                
                <ul class="list-group">
                    @foreach($materis as $materi)
                        <li class="list-group-item">
                            <a href="{{ route('users.quis.show', $materi->id) }}">{{ $materi->judul }}</a>
                        </li>
                    @endforeach
                </ul>
                
                <!-- Pagination links -->
                <div class="mt-3">
                    {{ $materis->links() }}
                </div>
                <a href="/" class="btn btn-sm btn-secondary mt-4">Kembali</a>

            </div>
        </div>
    </div>
@endsection
