@extends('a_components.layout')

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h1>Unggah Materi Baru</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.materi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Materi</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}">
                        @error('judul')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="materi1" class="form-label">Materi 1 (PDF)</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="materi1" name="materi1" accept="application/pdf" onchange="previewFile(this, 'previewMateri1')">
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePreview('previewMateri1')">Show</button>
                        </div>
                        <div id="loadingMateri1" class="mt-2" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <span>Uploading...</span>
                        </div>
                        @error('materi1')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                        <iframe id="previewMateri1" class="mt-3" style="width: 100%; height: 400px; display: none;"></iframe>
                    </div>
                    <div class="mb-3">
                        <label for="materi2" class="form-label">Materi 2 (PDF)</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="materi2" name="materi2" accept="application/pdf" onchange="previewFile(this, 'previewMateri2')">
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePreview('previewMateri2')">Show</button>
                        </div>
                        <div id="loadingMateri2" class="mt-2" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <span>Uploading...</span>
                        </div>
                        @error('materi2')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                        <iframe id="previewMateri2" class="mt-3" style="width: 100%; height: 400px; display: none;"></iframe>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ url()->previous() }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function previewFile(input, previewId) {
            const file = input.files[0];
            const preview = document.getElementById(previewId);
            const loading = document.getElementById('loading' + previewId);
            if (file && file.type === "application/pdf") {
                loading.style.display = 'block';
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    loading.style.display = 'none';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                loading.style.display = 'none';
            }
        }

        function togglePreview(previewId) {
            const preview = document.getElementById(previewId);
            if (preview.style.display === 'none' || preview.src === '') {
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }
        }
    </script>
@endsection