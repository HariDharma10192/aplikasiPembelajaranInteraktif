@extends('u_components.layout')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1>Laporan Kuis</h1>
                <a href="/" class="btn btn-sm btn-secondary">Kembali</a>
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
                <!-- Tempat untuk Card Detail Laporan -->
                <div id="laporanDetailContainer"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var form = document.getElementById('laporanForm');
            var select = document.getElementById('materiSelect');
            var laporanDetailContainer = document.getElementById('laporanDetailContainer');
            var quisChart;

            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Mencegah submit default
                var materiId = select.value;
                if (materiId) {
                    fetch('/users/quis/laporan/' + materiId)
                        .then(response => response.json())
                        .then(data => {
                            var laporanHTML = `
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h5>${data.materi.judul}</h5>
                                    </div>
                                    <div class="card-body">
                            `;

                            if (data.userJawabQuis) {
                                laporanHTML += `
                                    <h2>Nilai:      ${data.userJawabQuis.nilai}</h2>
                                    <h2>Jumlah Pertanyaan: ${data.userJawabQuis.total_questions}</h2>
                                    <h2>Jawaban Benar: ${data.userJawabQuis.correct_answers}</h2>
                                    <canvas id="quisChart" width="400" height="200"></canvas>
                                `;
                            } else {
                                laporanHTML += `
                                    <p>Anda belum menjawab kuis ini.</p>
                                    <a href="/users/quis/${materiId}" class="btn btn-success">AYO QUIS</a>
                                `;
                            }

                            laporanHTML += `
                                    </div>
                                </div>
                            `;

                            laporanDetailContainer.innerHTML = laporanHTML;

                            if (data.userJawabQuis) {
                                var ctx = document.getElementById('quisChart').getContext('2d');
                                if (quisChart) {
                                    quisChart.destroy();
                                }
                                quisChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: ['Total Pertanyaan', 'Jawaban Benar'],
                                        datasets: [{
                                            label: 'Hasil Kuis',
                                            data: [data.userJawabQuis.total_questions, data.userJawabQuis.correct_answers],
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
                                                beginAtZero: true,
                                                ticks: {
                                                    font: {
                                                        size: 16 // Ubah ukuran font sumbu y
                                                    }
                                                }
                                            },
                                            x: {
                                                ticks: {
                                                    font: {
                                                        size: 16 // Ubah ukuran font sumbu x
                                                    }
                                                }
                                            }
                                        },
                                        plugins: {
                                            legend: {
                                                labels: {
                                                    font: {
                                                        size: 16 // Ubah ukuran font legenda
                                                    }
                                                }
                                            },
                                            tooltip: {
                                                titleFont: {
                                                    size: 16 // Ubah ukuran font judul tooltip
                                                },
                                                bodyFont: {
                                                    size: 16 // Ubah ukuran font isi tooltip
                                                },
                                                footerFont: {
                                                    size: 16 // Ubah ukuran font footer tooltip
                                                }
                                            }
                                        }
                                    }
                                });
                            }
                        });
                }
            });
        });
    </script>
@endsection
