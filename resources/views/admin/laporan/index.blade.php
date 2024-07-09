@extends('a_components.layout')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>Laporan Nilai Pengguna</h1>
            </div>
            <div class="card-body">
                <form method="GET" id="laporanForm" class="mb-3">
                    <div class="input-group">
                        <select name="materi_id" id="materiSelect" class="form-control">
                            <option value="" disabled selected>=== Pilih Judul Materi ===</option>
                            @foreach($materis as $materi)
                                <option value="{{ $materi->id }}">{{ $materi->judul }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-success" type="submit">Lihat Laporan</button>
                    </div>
                </form>
                <div id="laporanDetailContainer" style="display: none;">
                    <canvas id="nilaiChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var form = document.getElementById('laporanForm');
            var select = document.getElementById('materiSelect');
            var laporanDetailContainer = document.getElementById('laporanDetailContainer');
            var nilaiChart;

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                var materiId = select.value;
                if (materiId) {
                    fetch('/admin/laporan/data/' + materiId)
                        .then(response => response.json())
                        .then(data => {
                            var ctx = document.getElementById('nilaiChart').getContext('2d');
                            if (nilaiChart) {
                                nilaiChart.destroy();
                            }
                            nilaiChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: data.data.map(item => item.user),
                                    datasets: [{
                                        label: 'Nilai Pengguna',
                                        data: data.data.map(item => item.nilai),
                                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
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
                            laporanDetailContainer.style.display = 'block';
                        });
                }
            });
        });
    </script>
@endsection
