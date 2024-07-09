@extends('a_components.layout')

@section('content')
<style>
    /* ... (style yang sama seperti sebelumnya) ... */
</style>

<div class="container-fluid mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
            <h1 class="mb-2 mb-md-0">Detail Evaluasi - {{ $materi->judul }}</h1>
            <a href="{{ route('admin.quis.evaluasi') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
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
                            <th>Nama Pengguna</th>
                            <th>Nilai</th>
                            <th>Total Pertanyaan</th>
                            <th>Jawaban Benar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userJawabQuis as $jawab)
                            <tr>
                                <td>{{ $jawab->user->name }}</td>
                                <td>{{ $jawab->nilai }}</td>
                                <td>{{ $jawab->total_questions }}</td>
                                <td>{{ $jawab->correct_answers }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
                <div class="mb-2 mb-md-0">
                    {{-- <a href="{{ route('admin.quis.evaluasi') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a> --}}
                </div>
                <div>
                    {{ $userJawabQuis->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection