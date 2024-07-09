@extends('a_components.layout')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>Tambah Kuis</h1>
            </div>
            <div class="card-body">
                @if(session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('admin.quis.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="materi_id" class="form-label">Materi</label>
                        <select name="materi_id" id="materi_id" class="form-control" required>
                            <option value="" disabled selected>==== Pilih Materi Terkait ====</option>
                            @foreach($materis as $materi)
                                <option value="{{ $materi->id }}">{{ $materi->judul }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="questions-container">
                        <div class="question-item mb-4">
                            <h5>Pertanyaan 1</h5>
                            <div class="mb-3">
                                <label class="form-label">Pertanyaan</label>
                                <input type="text" name="questions[0][question]" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Opsi A</label>
                                <input type="text" name="questions[0][option_a]" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Opsi B</label>
                                <input type="text" name="questions[0][option_b]" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Opsi C</label>
                                <input type="text" name="questions[0][option_c]" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Opsi D</label>
                                <input type="text" name="questions[0][option_d]" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jawaban Benar</label>
                                <select name="questions[0][correct_answer]" class="form-control" required>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" class="btn btn-secondary" onclick="addQuestion()">Tambah Pertanyaan</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        let questionIndex = 1;

        function addQuestion() {
            const container = document.getElementById('questions-container');
            const newQuestion = document.createElement('div');
            newQuestion.classList.add('question-item', 'mb-4');
            newQuestion.innerHTML = `
                <h5>Pertanyaan ${questionIndex + 1}</h5>
                <div class="mb-3">
                    <label class="form-label">Pertanyaan</label>
                    <input type="text" name="questions[${questionIndex}][question]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Opsi A</label>
                    <input type="text" name="questions[${questionIndex}][option_a]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Opsi B</label>
                    <input type="text" name="questions[${questionIndex}][option_b]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Opsi C</label>
                    <input type="text" name="questions[${questionIndex}][option_c]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Opsi D</label>
                    <input type="text" name="questions[${questionIndex}][option_d]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jawaban Benar</label>
                    <select name="questions[${questionIndex}][correct_answer]" class="form-control" required>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
            `;
            container.appendChild(newQuestion);
            questionIndex++;
        }
    </script>
@endsection