@extends('a_components.layout')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1>Detail Evaluasi - {{ $materi->judul }}</h1>
                <a href="{{ route('admin.quis.evaluasi') }}" class="btn btn-sm btn-secondary">Kembali</a>
            </div>
            <div class="card-body">
                @if(session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>Nama Pengguna</th>
                            <th>Nilai</th>
                            <th>Total Pertanyaan</th>
                            <th>Jawaban Benar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materi->userJawabQuis as $jawab)
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
        </div>
    </div>
@endsection
