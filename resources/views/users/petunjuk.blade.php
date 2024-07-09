@extends('u_components.layout')

@section('content')    
<div class="container mt-5">
    <div class="card shadow-lg bg-light p-4">
        <div class="card-header bg-success text-white text-center">
            <h1>Cara Penggunaan Aplikasi</h1>
        </div>
        <div class="card-body">
            <ol class="list-group list-group-flush mb-4">
                <li class="list-group-item bg-light">1. Setiap Pengguna harus melakukan <strong>mendaftar</strong> terlebih dahulu.</li>
                <li class="list-group-item bg-light">2. Setelah terdaftar, pengguna harus melakukan <strong>login</strong> masuk terlebih dahulu di menu login.</li>
            </ol>
            <h2 class="text-center mb-4">Petunjuk Evaluasi</h2>
            <ol class="list-group list-group-flush">
                <li class="list-group-item bg-light">1. Pilih <strong>judul materi</strong> yang ingin di lakukan evaluasi.</li>
                <li class="list-group-item bg-light">2. Pada lembar pertanyaan terdapat beberapa <strong>soal</strong>.</li>
                <li class="list-group-item bg-light">3. Pilihlah <strong>jawaban</strong> pertanyaan pada lembar jawaban A-B-C-D yang disediakan.</li>
                <li class="list-group-item bg-light">4. Setiap <strong>jawaban yang benar</strong> akan mendapatkan <strong>skor rata-rata</strong>.</li>
                <li class="list-group-item bg-light">5. Contoh: Jika ada 10 soal dan anda benar 8 maka <strong>nilai anda 80</strong>.</li>
                <li class="list-group-item bg-light">6. Target nilai minimal untuk evaluasi adalah <strong>60</strong>. Evaluasi tidak dapat diulang.</li>
            </ol>
            <div class="text-start mt-4">
                <a href="/" class="btn btn-secondary btn-lg">Kembali</a>
            </div>
        </div>
    </div>
</div>

<style>
    .card-header {
        /* background: linear-gradient(45deg, #1e3c72, #2a5298); */
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
