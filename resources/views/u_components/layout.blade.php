<!-- resources/views/components/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Pembelajaran Interactive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
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
        .menu-item {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px;
            text-decoration: none;
            margin: 5px 0;
            font-size: 20px;
            font-weight: bold;
        }
        .menu-item:first-child {
            background-color: #8BC34A;
            color: #1B5E20;
        }
        body {
        background-image: url('/bg-admin.jpeg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-color: #f0f8ff;
        font-family: 'Comic Neue', cursive, sans-serif;
    }
        .kid-friendly-title {
    font-family: 'Comic Neue', cursive;
    text-align: center;
    color: #FFFFFF;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    font-size: 3rem;
    font-weight: bold;
    padding: 20px;
    border-radius: 15px;
    background-color: rgba(76, 175, 80, 0.8);
    box-shadow: 0 0 20px rgba(76, 175, 80, 0.6);
    animation: bounce 2s infinite;
    cursor: pointer;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}
        
        .title-container {
            background-color: rgba(241, 241, 241, 0.8);
            border-radius: 20px;
            padding: 10px;
            margin-top: 20px;
        }
        .card {
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border: 3px solid #4CAF50;
        }
        .card-header {
            background-color: #4CAF50;
            color: white;
            border-top-left-radius: 17px;
            border-top-right-radius: 17px;
        }
        .btn {
            border-radius: 15px;
            font-size: 1rem;
            padding: 8px 15px;
        }
        .btn-danger {
            background-color: #FF6347;
            border-color: #FF4500;
        }
        .table {
            border-radius: 15px;
            overflow: hidden;
        }
        .table th {
            background-color: #87CEEB;
            color: #000080;
        }
        .table-hover tbody tr:hover {
            background-color: #E6E6FA;
        }
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
        .alert {
            border-radius: 15px;
            font-size: 1.1rem;
        }
        .form-control {
            border-radius: 15px;
        }
        .pagination {
            font-size: 1.1rem;
        }
        .pagination .page-item .page-link {
            border-radius: 10px;
            margin: 0 2px;
        }
    </style>
</head>
<body class="bd-secondary container vh-100 position-relative">
    <audio id="titleAudio" style="display: none;">
        <source src="http://commondatastorage.googleapis.com/codeskulptor-assets/week7-brrring.m4a" type="audio/mp4">
        Your browser does not support the audio element.
    </audio>

    <header class="mb-5 mt-5">
        <div class="title-container">
            <h1 class="kid-friendly-title" id="interactiveTitle">
                {{ $headerText ?? 'Aplikasi Pembelajaran Interactive' }}
            </h1>
        </div>
    </header>

    @if(session()->has('success'))
        <div class="container container-narrow">
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        </div>
    @endif
    @if(session()->has('error'))
        <div class="container container-narrow">
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        </div>
    @endif

    @yield('content')

    <!-- Audio control dengan badge -->
    <div id="audio-control" class="audio-control-badge">
        <i class="fas fa-volume-up" style="color: #4CAF50;"></i>
    </div>

    <audio id="background-audio" loop>
        <source src="https://codeskulptor-demos.commondatastorage.googleapis.com/GalaxyInvaders/theme_01.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var title = document.getElementById('interactiveTitle');
            var titleAudio = document.getElementById('titleAudio');

            title.addEventListener('click', function() {
                if (titleAudio.paused) {
                    titleAudio.play();
                } else {
                    titleAudio.pause();
                    titleAudio.currentTime = 0;
                }
            });

            var audio = document.getElementById("background-audio");
            var audioControl = $("#audio-control");
            var isPlaying = false;

            function toggleAudio() {
                if (isPlaying) {
                    audio.pause();
                    audioControl.html('<i class="fas fa-volume-mute" style="color: #FF6347;"></i>');
                } else {
                    audio.play();
                    audioControl.html('<i class="fas fa-volume-up" style="color: #4CAF50;"></i>');
                }
                isPlaying = !isPlaying;
                localStorage.setItem('audioPlaying', isPlaying);
            }

            audioControl.click(toggleAudio);

            if(localStorage.getItem('audioPlaying') === 'true') {
                audio.play();
                isPlaying = true;
                audioControl.html('<i class="fas fa-volume-up" style="color: #4CAF50;"></i>');
            }

            $(audio).on('play', function() {
                localStorage.setItem('audioPlaying', 'true');
            });

            $(audio).on('pause', function() {
                localStorage.setItem('audioPlaying', 'false');
            });
        });
    </script>

    @yield('scripts')
</body>
</html>