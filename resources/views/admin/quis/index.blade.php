@extends('a_components.layout')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1 class="mb-0">Daftar Kuis</h1>
                <a href="/admin/quis/create" class="btn btn-sm btn-success">Tambah Kuis Baru</a>
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
                            <th>Judul Materi</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban Benar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materis as $materi)
                            <tr class="materi-header" data-toggle="materi-{{ $materi->id }}">
                                <td colspan="3"><strong>{{ $materi->judul }}</strong></td>
                            </tr>
                            @foreach($materi->quis as $quis)
                                <tr class="materi-content materi-{{ $materi->id }}" style="display: none;">
                                    <td></td>
                                    <td>
                                        <button class="btn btn-link" onclick="showQuisModal('{{ $quis->question }}', '{{ $quis->option_a }}', '{{ $quis->option_b }}', '{{ $quis->option_c }}', '{{ $quis->option_d }}', '{{ $quis->correct_answer }}')">
                                            {{ \Illuminate\Support\Str::words($quis->question, 15) }}
                                        </button>
                                    </td>
                                    <td>{{ \Illuminate\Support\Str::words($quis->correct_answer, 15) }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
                <a href="/" class="btn btn-sm btn-secondary mb-3">Kembali</a>
                
                <!-- Tambahkan tombol menuju ke halaman pembuatan kuis -->
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="quisModal" tabindex="-1" aria-labelledby="quisModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="quisModalLabel">Detail Kuis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Pertanyaan:</strong> <span id="modalQuestion"></span></p>
                    <p><strong>Opsi A:</strong> <span id="modalOptionA"></span></p>
                    <p><strong>Opsi B:</strong> <span id="modalOptionB"></span></p>
                    <p><strong>Opsi C:</strong> <span id="modalOptionC"></span></p>
                    <p><strong>Opsi D:</strong> <span id="modalOptionD"></span></p>
                    <p><strong>Jawaban Benar:</strong> <span id="modalCorrectAnswer"></span></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showQuisModal(question, optionA, optionB, optionC, optionD, correctAnswer) {
            document.getElementById('modalQuestion').innerText = question;
            document.getElementById('modalOptionA').innerText = optionA;
            document.getElementById('modalOptionB').innerText = optionB;
            document.getElementById('modalOptionC').innerText = optionC;
            document.getElementById('modalOptionD').innerText = optionD;
            document.getElementById('modalCorrectAnswer').innerText = correctAnswer;
            
            var quisModal = new bootstrap.Modal(document.getElementById('quisModal'), {});
            quisModal.show();
        }

        document.addEventListener('DOMContentLoaded', function () {
            var headers = document.querySelectorAll('.materi-header');
            headers.forEach(function(header) {
                header.addEventListener('click', function() {
                    var materiId = this.getAttribute('data-toggle');
                    var contents = document.querySelectorAll('.' + materiId);
                    contents.forEach(function(content) {
                        if (content.style.display === 'none') {
                            content.style.display = 'table-row';
                        } else {
                            content.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
@endsection
