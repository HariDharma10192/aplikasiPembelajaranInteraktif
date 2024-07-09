<!-- resources/views/admin/laporan/show.blade.php -->

@extends('u_components.layout')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1>Detail Laporan: {{ $materi->judul }}</h1>
        </div>
        <div class="card-body">
            <canvas id="myChart" width="400" height="200"></canvas>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Nilai</th>
                        <th>Total Pertanyaan</th>
                        <th>Jawaban Benar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>{{ $item->user_id }}</td>
                        <td>{{ $item->nilai }}</td>
                        <td>{{ $item->total_questions }}</td>
                        <td>{{ $item->correct_answers }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const chartData = @json($data);
    const labels = chartData.map(item => `User ${item.user_id}`);
    const values = chartData.map(item => item.nilai);

    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Nilai',
                data: values,
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
</script>
@endsection
