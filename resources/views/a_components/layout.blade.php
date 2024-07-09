<!-- resources/views/components/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Pembelajaran Interactive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-DyZ88mC6Up2uqSBB0+AB+V5CpC5PHMRvN7y9Q/kn6/2FXzIbZBz/GRzVjew4/yz2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<style>
    .menu-item {
        background-color: limegreen;
        color: white;
        text-align: center;
        padding: 20px;
        text-decoration: none;
        margin: 5px 0;
        font-size: 20px;
        font-weight: bold;
    }
    .menu-item:first-child {
        background-color: yellow;
        color: black;
    }
    body {
        background-image: url('/bg-admin.jpeg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

</style>
<body class="bd-secondary container vh-100 position-relative">
    <header class="mb-5 mt-5">
        <h1 class="text-center display-2 bg-light">
            <p>{{ $headerText ?? 'Aplikasi Pembelajaran Interactive' }}</p>
        </h1>
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
    @yield('scripts')

</body>
</html>  