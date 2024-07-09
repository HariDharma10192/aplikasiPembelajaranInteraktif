@extends('u_components.layout')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>Daftar Materi 2</h1>
            </div>
            <div class="card-body">
                <!-- Form pencarian -->
                <form method="GET" action="{{ route('users.materi.materi2') }}" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan judul" value="{{ request()->search }}">
                        <button class="btn btn-success" type="submit">Cari</button>
                    </div>
                </form>
                
                <ul class="list-group">
                    @foreach($materis as $materi)
                        @if($materi->materi2) <!-- Tampilkan hanya jika materi 2 ada -->
                            <li class="list-group-item">
                                <a href="#" class="materi2-link" data-id="{{ $materi->id }}">{{ $materi->judul }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
                
                <!-- Pagination links -->
                <div class="mt-3">
                    {{ $materis->links() }}
                </div>
                <a href="/" class="btn btn-sm btn-secondary mt-4">Kembali</a>

            </div>

        </div>
    </div>

    <!-- Modal untuk Materi 2 -->
    <div class="modal fade" id="materi2Modal" tabindex="-1" aria-labelledby="materi2ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="materi2ModalLabel">Materi 2</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="materi2Iframe" frameborder="0" style="width: 100%; height: 500px;"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var materi2Links = document.querySelectorAll('.materi2-link');
            materi2Links.forEach(function (link) {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    var materiId = this.getAttribute('data-id');
                    fetchMateri2(materiId);
                });
            });

            function fetchMateri2(id) {
                fetch('/users/materi/' + id + '/materi2')
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('materi2ModalLabel').innerText = data.judul + " - Materi 2";
                        document.getElementById('materi2Iframe').src = '/storage/' + data.materi2;

                        var materi2Modal = new bootstrap.Modal(document.getElementById('materi2Modal'), {});
                        materi2Modal.show();
                    });
            }
        });
    </script>
@endsection
