@extends('a_components.layout')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg bg-light p-4">
            <div class="card-header bg-success text-white text-center">
                <h1>Petunjuk Penggunaan Aplikasi</h1>
            </div>
            <div class="card-body">
                <h2>Cara Penggunaan Aplikasi</h2>
                <ol class="list-group list-group-flush mb-4">
                    <li class="list-group-item bg-light">1. Setiap Pengguna harus melakukan <strong>mendaftar</strong> terlebih dahulu.</li>
                    <li class="list-group-item bg-light">2. Setelah terdaftar, penguna harus melakukan <strong>login</strong> masuk terlebih dahulu di menu login.</li>
                    <li class="list-group-item bg-light">3. Setelah hal diatas, penguna dapat melakukan <strong>kelola menu yang ada</strong> sebagai pembelajaran semestinya.</li>
                </ol>
                {{-- <h2 class="text-center mb-4">Petunjuk Evaluasi</h2>
                <ol class="list-group list-group-flush">
                    <li class="list-group-item bg-light">Pilih <strong>judul materi</strong> yang ingin di lakukan evaluasi.</li>
                    <li class="list-group-item bg-light">Pada lembar pertanyaan terdapat <strong>beberapa soal</strong>.</li>
                    <li class="list-group-item bg-light">Pilihlah jawaban pertanyaan pada lembar jawaban <strong>A-B-C-D</strong> yang disediakan.</li>
                    <li class="list-group-item bg-light">Setiap jawaban yang benar akan mendapatkan <strong>skor rata-rata</strong>.</li>
                    <li class="list-group-item bg-light">Contoh: Jika ada 10 soal dan anda benar 8 maka nilai anda 80.</li>
                    <li class="list-group-item bg-light">Target nilai minimal untuk evaluasi adalah 60. Evaluasi tidak dapat diulang.</li>
                </ol> --}}
                <div class="text-start mt-4">
                    <a href="/" class="btn btn-sm btn-secondary btn-lg">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card-header {
            color: white;
            padding: 20px;
        }

        .card-body {
            background-color: #f9f9f9;
        }

        .list-group-item {
            font-size: 1.1em;
            border: none;
        }

        .list-group-item.bg-light {
            background-color: #ffffff;
        }

        .btn-lg {
            font-size: 1.2em;
            padding: 10px 20px;
            border-radius: 30px;
        }
    </style>
@endsection
