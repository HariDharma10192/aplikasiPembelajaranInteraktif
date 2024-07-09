@extends('a_components.layout')

@section('content')
<style>
    .action-buttons {
        display: flex;
        gap: 5px;
        justify-content: flex-start;
    }
    .action-buttons .btn {
        flex: 0 1 auto;
        min-width: 60px;
    }
    .action-buttons form {
        flex: 0 1 auto;
        margin: 0;
    }
    @media (max-width: 768px) {
        .action-buttons {
            flex-direction: column;
        }
        .action-buttons .btn,
        .action-buttons form {
            width: 100%;
        }
    }
</style>

<div class="container-fluid mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
            <h1 class="mb-2 mb-md-0">Daftar Materi</h1>
            <a href="{{ route('admin.materi.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Materi
            </a>
        </div>
        <div class="card-body">
            <!-- Form pencarian -->
            <form method="GET" action="{{ route('admin.materi.index') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan judul" value="{{ request()->search }}">
                    <button class="btn btn-success" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>

            @if(session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
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
                                <td><button class="btn btn-link text-success" onclick="showPdf('{{ Storage::url($materi->materi1) }}')">Lihat Materi 1</button></td>
                                <td>
                                    @if($materi->materi2)
                                        <button class="btn btn-link text-success" onclick="showPdf('{{ Storage::url($materi->materi2) }}')">Lihat Materi 2</button>
                                    @else
                                        <button class="btn btn-link text-secondary" onclick="showPdf('{{ Storage::url($materi->materi2) }}')">Tidak Tersedia</button>
                                    @endif
                                </td>                                <td>
                                    <div class="action-buttons">
                                        @if($materi->quis_count == 0)
                                            <form action="{{ route('admin.materi.destroy', $materi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-secondary btn-sm" disabled>
                                                <i class="fas fa-lock"></i> Terikat dengan Kuis
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
                <div class="mb-2 mb-md-0">
                    <a href="/" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div>
                    {{ $materis->links() }} <!-- Assuming you're using pagination -->
                </div>
            </div>
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
