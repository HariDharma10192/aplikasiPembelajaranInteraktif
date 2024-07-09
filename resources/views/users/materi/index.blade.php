@extends('u_components.layout')

@section('content')

<style>
    .animated-item {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s ease, transform 0.5s ease;
    }
    .animated-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>


    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>Daftar Materi</h1>
            </div>
            <div class="card-body">
                <!-- Form pencarian -->
                <form method="GET" action="{{ route('users.materi.index') }}" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan judul" value="{{ request()->search }}">
                        <button class="btn btn-success " type="submit">Cari</button>
                    </div>
                </form>
                
                <ul class="list-group">
                    @foreach($materis as $materi)
                        <li class="list-group-item p-0 mb-2 border-0">
                            <a href="#" class="materi-link btn btn-outline-success w-100 text-start d-flex align-items-center animated-item" data-id="{{ $materi->id }}">
                                <i class="fas fa-file-alt me-2"></i>
                                <span>{{ $materi->judul }}</span>
                            </a>
                        </li>
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

    <!-- Modal untuk Materi 1 -->
    <div class="modal fade" id="materiModal" tabindex="-1" aria-labelledby="materiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="materiModalLabel">Materi 1</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="materiIframe" frameborder="0" style="width: 100%; height: 500px;"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" id="nextMateriButton" class="btn btn-primary" style="display: none;">Lanjut Membaca Materi 2</button>
                </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.animated-item').each(function(index) {
                var $item = $(this);
                setTimeout(function() {
                    $item.css({
                        'opacity': 1,
                        'transform': 'translateY(0)'
                    });
                }, index * 100);
            });
        });
        </script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {
            var materiLinks = document.querySelectorAll('.materi-link');
            materiLinks.forEach(function (link) {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    var materiId = this.getAttribute('data-id');
                    fetchMateri(materiId);
                });
            });

            function fetchMateri(id) {
                fetch('/users/materi/' + id + '/materi1')
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('materiModalLabel').innerText = data.judul;
                        document.getElementById('materiIframe').src = '/storage/' + data.materi1;

                        var nextMateriButton = document.getElementById('nextMateriButton');
                        if (data.materi2) {
                            nextMateriButton.style.display = 'inline-block';
                            nextMateriButton.onclick = function () {
                                var materiModal = bootstrap.Modal.getInstance(document.getElementById('materiModal'));
                                materiModal.hide();
                                showMateri2(data.judul, data.materi2);
                            };
                        } else {
                            nextMateriButton.style.display = 'none';
                        }

                        var materiModal = new bootstrap.Modal(document.getElementById('materiModal'), {});
                        materiModal.show();
                    });
            }

            function showMateri2(judul, materi2) {
                document.getElementById('materi2ModalLabel').innerText = judul + " - Materi 2";
                document.getElementById('materi2Iframe').src = '/storage/' + materi2;

                var materi2Modal = new bootstrap.Modal(document.getElementById('materi2Modal'), {});
                materi2Modal.show();
            }
        });
    </script>
@endsection