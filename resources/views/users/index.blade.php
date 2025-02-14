@extends('u_components.layout')

@section('content')    
<style>
    .svg-container {
        max-width: 100%;
        height: auto;
    }
    .parallax {
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .sidebar-btn {
        opacity: 0;
        transform: translateX(-50px);
        transition: opacity 0.5s ease, transform 0.5s ease;
        border-radius: 20px;
        margin-bottom: 10px;
        font-size: 18px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border: none;
    }
    .logout-btn {
        opacity: 0;
        transform: translateX(-50px);
        transition: opacity 1s ease, transform 1s ease;
        border-radius: 20px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border: none;
    }
    .sidebar-btn i, .logout-btn i {
        margin-right: 10px;
        font-size: 24px;
    }
    .sidebar-btn:hover, .logout-btn:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }
    .sidebar-container {
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 30px;
        padding: 20px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    .audio-control-badge {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 60px;
        height: 60px;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
        z-index: 1000;
    }
    .audio-control-badge:hover {
        transform: scale(1.1);
    }
    .audio-control-badge i {
        font-size: 24px;
    }
    .welcome-message {
      width: 100%;
    }
    @media (min-width: 768px) {
      .welcome-message {
        width: 25%;
      }
    }
</style>

<p class="welcome-message p-2 text-center bg-light border-2 border-secondary text-capitalize" style="border-radius: 15px;">Selamat Datang, {{auth()->user()->name}}</p>

<div class="row gap-5">
    <div class="col-12 col-md-4 col-lg-3">
        <div class="sidebar-container">
            <div class="d-flex flex-column gap-1 w-100">
                <a href="/users/laporan" class="btn btn-warning w-100 text-center sidebar-btn"><i class="fas fa-chart-line"></i>Kompetensi</a>
                <a href="/users/materi" class="btn btn-success w-100 text-center sidebar-btn"><i class="fas fa-book"></i>Materi 1</a>
                <a href="users/materi2" class="btn btn-success w-100 text-center sidebar-btn"><i class="fas fa-book-open"></i>Materi 2</a>
                <a href="/users/quis" class="btn btn-info w-100 text-center sidebar-btn"><i class="fas fa-tasks"></i>Evaluasi</a>
                <a href="/petunjuk" class="btn btn-secondary w-100 text-center sidebar-btn"><i class="fas fa-info-circle"></i>Petunjuk</a>
                <a href="/users/laporan" class="btn btn-dark w-100 text-center sidebar-btn"><i class="fas fa-file-alt"></i>Laporan</a>
                <a href="#" id="logoutBtn" class="btn btn-danger w-100 text-center mt-5 logout-btn"><i class="fas fa-sign-out-alt"></i>Log Out</a>
            </div>
        </div>
    </div>
    <div class="col-7 d-flex justify-content-center">
        <div class="svg-container d-none d-md-block">
            <?xml version="1.0" standalone="no"?><!-- Generator: Gravit.io --><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="isolation:isolate" viewBox="0 0 450 450" width="350" height="350"><defs><clipPath id="_clipPath_wCoq9Su88WbOSjHM91FmU9oia7rRMwYR"><rect width="450" height="450"/></clipPath></defs><g clip-path="url(#_clipPath_wCoq9Su88WbOSjHM91FmU9oia7rRMwYR)"><g id="Group"><path d="M 28.569 232.952 L 95.325 232.952 C 98.834 232.952 101.683 235.801 101.683 239.31 L 101.683 426.642 C 101.683 430.151 98.834 433 95.325 433 L 28.569 433 C 25.06 433 22.212 430.151 22.212 426.642 L 22.212 239.31 C 22.212 235.801 25.06 232.952 28.569 232.952 Z" style="stroke:none;fill:#0091FF;stroke-miterlimit:10;"/><path d="M 75.971 235.692 L 80.808 235.692 C 81.742 235.692 82.5 236.451 82.5 237.385 L 82.5 371.019 C 82.5 371.953 81.742 372.712 80.808 372.712 L 75.971 372.712 C 75.037 372.712 74.279 371.953 74.279 371.019 L 74.279 237.385 C 74.279 236.451 75.037 235.692 75.971 235.692 Z" style="stroke:none;fill:#A4D1F4;stroke-miterlimit:10;"/><path d="M 44.964 356.269 L 51.527 356.269 C 51.984 356.269 52.356 356.641 52.356 357.098 L 52.356 388.325 C 52.356 388.782 51.984 389.154 51.527 389.154 L 44.964 389.154 C 44.506 389.154 44.135 388.782 44.135 388.325 L 44.135 357.098 C 44.135 356.641 44.506 356.269 44.964 356.269 Z" style="stroke:none;fill:#A4D1F4;stroke-miterlimit:10;"/><path d="M 44.964 276.798 L 51.527 276.798 C 51.984 276.798 52.356 277.17 52.356 277.627 L 52.356 308.854 C 52.356 309.311 51.984 309.683 51.527 309.683 L 44.964 309.683 C 44.506 309.683 44.135 309.311 44.135 308.854 L 44.135 277.627 C 44.135 277.17 44.506 276.798 44.964 276.798 Z" style="stroke:none;fill:#A4D1F4;stroke-miterlimit:10;"/><rect x="101.683" y="285.019" width="24.663" height="142.5" transform="matrix(1,0,0,1,0,0)" fill="rgb(249,99,0)"/><rect x="126.346" y="208.288" width="24.663" height="221.971" transform="matrix(1,0,0,1,0,0)" fill="rgb(199,80,0)"/><path d="M 164.712 148 L 178.413 148 C 185.976 148 192.115 154.14 192.115 161.702 L 192.115 419.298 C 192.115 426.86 185.976 433 178.413 433 L 164.712 433 C 157.149 433 151.01 426.86 151.01 419.298 L 151.01 161.702 C 151.01 154.14 157.149 148 164.712 148 Z" style="stroke:none;fill:#0091FF;stroke-miterlimit:10;"/><rect x="151.01" y="276.798" width="41.106" height="30.144" transform="matrix(1,0,0,1,0,0)" fill="rgb(57,31,153)"/><rect x="151.01" y="364.49" width="41.106" height="30.144" transform="matrix(1,0,0,1,0,0)" fill="rgb(57,31,153)"/><rect x="151.01" y="186.365" width="41.106" height="30.144" transform="matrix(1,0,0,1,0,0)" fill="rgb(57,31,153)"/><path d="M 205.68 230.212 L 260.762 230.212 C 268.249 230.212 274.327 236.29 274.327 243.776 L 274.327 419.435 C 274.327 426.922 268.249 433 260.762 433 L 205.68 433 C 198.194 433 192.115 426.922 192.115 419.435 L 192.115 243.776 C 192.115 236.29 198.194 230.212 205.68 230.212 Z" style="stroke:none;fill:#815EFF;stroke-miterlimit:10;"/><rect x="192.115" y="260.356" width="82.212" height="142.5" transform="matrix(1,0,0,1,0,0)" fill="rgb(129,94,255)"/><rect x="277.067" y="202.808" width="79.471" height="230.192" transform="matrix(1,0,0,1,0,0)" fill="rgb(247,181,0)"/><rect x="304.471" y="290.5" width="24.663" height="24.663" transform="matrix(1,0,0,1,0,0)" fill="rgb(99,40,0)"/><rect x="304.471" y="246.654" width="24.663" height="24.663" transform="matrix(1,0,0,1,0,0)" fill="rgb(99,40,0)"/><rect x="304.471" y="337.087" width="24.663" height="24.663" transform="matrix(1,0,0,1,0,0)" fill="rgb(99,40,0)"/><rect x="359.279" y="249.394" width="68.51" height="183.606" transform="matrix(1,0,0,1,0,0)" fill="rgb(149,59,0)"/><rect x="359.279" y="285.019" width="68.51" height="24.663" transform="matrix(1,0,0,1,0,0)" fill="rgb(255,255,255)"/><rect x="359.279" y="337.087" width="68.51" height="24.663" transform="matrix(1,0,0,1,0,0)" fill="rgb(255,255,255)"/></g></g></svg>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Parallax effect
        $(window).scroll(function() {
            var scrollPosition = $(this).scrollTop();
            $('.parallax').css('background-position-y', -(scrollPosition * 0.5) + 'px');
        });

        // Animate sidebar buttons on page load
        $('.sidebar-btn').each(function(index) {
            var $btn = $(this);
            setTimeout(function() {
                $btn.css({
                    'opacity': 1,
                    'transform': 'translateX(0)'
                });
            }, index * 100);
        });

        // Animate logout button
        setTimeout(function() {
            $('.logout-btn').css({
                'opacity': 1,
                'transform': 'translateX(0)'
            });
        }, 1000); // Start after other buttons have animated

        // Logout confirmation
        $('#logoutBtn').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin ingin keluar?',
                showDenyButton: true,
                confirmButtonText: 'Iya',
                denyButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/sign-out';
                }
            });
        });
    });
</script>
@endsection