@extends('u_components.layout')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1>{{ $materi->judul }} - Kuis</h1>
                <a href="/" class="btn btn-sm btn-secondary">Kembali</a>
            </div>
            <div class="card-body">
                @if($userJawabQuis)
                    <p>Anda telah menyelesaikan kuis ini.</p>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nilaiModal">Lihat Nilai</button>
                @else
                    <form action="{{ route('users.quis.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="materi_id" value="{{ $materi->id }}">
                        @foreach($materi->quis as $index => $quis)
                            <div class="mb-3">
                                <label class="form-label"><strong>{{ $index + 1 }}. {{ $quis->question }}</strong></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answers[{{ $quis->id }}]" value="A" required>
                                    <label class="form-check-label">{{ $quis->option_a }}</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answers[{{ $quis->id }}]" value="B">
                                    <label class="form-check-label">{{ $quis->option_b }}</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answers[{{ $quis->id }}]" value="C">
                                    <label class="form-check-label">{{ $quis->option_c }}</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answers[{{ $quis->id }}]" value="D">
                                    <label class="form-check-label">{{ $quis->option_d }}</label>
                                </div>
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-success">Submit Jawaban</button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal untuk menampilkan nilai -->
    @if($userJawabQuis)
        <div class="modal fade" id="nilaiModal" tabindex="-1" aria-labelledby="nilaiModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="nilaiModalLabel">Nilai Kuis Anda</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Nilai: {{ $userJawabQuis->nilai }}</p>
                        <p>Jumlah Pertanyaan: {{ $userJawabQuis->total_questions }}</p>
                        <p>Jawaban Benar: {{ $userJawabQuis->correct_answers }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
