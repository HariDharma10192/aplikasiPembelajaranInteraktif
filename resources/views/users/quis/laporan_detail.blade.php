@extends('u_components.layout')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1>{{ $materi->judul }} - Laporan Kuis</h1>
                <a href="{{ route('users.quis.laporan') }}" class="btn btn-sm btn-secondary">Kembali</a>
            </div>
            <div class="card-body">
                @if($userJawabQuis)
                    <p>Nilai: {{ $userJawabQuis->nilai }}</p>
                    <p>Jumlah Pertanyaan: {{ $userJawabQuis->total_questions }}</p>
                    <p>Jawaban Benar: {{ $userJawabQuis->correct_answers }}</p>
                    <canvas id="quisChart" width="400" height="200"></canvas>
                @else
                    <p>Anda belum menjawab kuis ini.</p>
                    <a href="{{ route('users.quis.show', $materi->id) }}" class="btn btn-success">AYO QUIS</a>
                @endif
            </div>
        </div>
    </div>

    @if($userJawabQuis)
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var ctx = document.getElementById('quisChart').getContext('2d');
                var quisChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Total Pertanyaan', 'Jawaban Benar'],
                        datasets: [{
                            label: 'Hasil Kuis',
                            data: [{{ $userJawabQuis->total_questions }}, {{ $userJawabQuis->correct_answers }}],
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>
    @endif
@endsection
