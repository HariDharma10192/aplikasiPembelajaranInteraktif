@extends('a_components.layout')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1>Daftar Materi</h1>
                <a href="{{ route('admin.materi.create') }}" class="btn btn-success">Tambah Materi</a>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.materi.index') }}" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan judul" value="{{ request()->search }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>

                @if(session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

               <!-- Wrapper for table to make it scrollable on mobile -->
               <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Judul</th>
                            <th>Materi 1</th>
                            <th>Materi 2</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materis as $materi)
                            <tr>
                                <td>{{ $materi->created_at->format('d-m-Y') }}</td>
                                <td>{{ $materi->judul }}</td>
                                <td><button class="btn btn-link" onclick="showPdf('{{ Storage::url($materi->materi1) }}')">Lihat Materi 1</button></td>
                                <td><button class="btn btn-link" onclick="showPdf('{{ Storage::url($materi->materi2) }}')">Lihat Materi 2</button></td>
                                <td>
                                    @if($materi->quis_count == 0)
                                        <form action="{{ route('admin.materi.destroy', $materi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary" disabled>Terikat dengan Kuis</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="/" class="btn btn-sm btn-secondary mt-3">Kembali</a>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Pratinjau PDF</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfViewer" style="width: 100%; height: 500px;" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function showPdf(url) {
            document.getElementById('pdfViewer').src = url;
            var pdfModal = new bootstrap.Modal(document.getElementById('pdfModal'), {});
            pdfModal.show();
        }
    </script>
@endsection
