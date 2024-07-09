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
            <h1>Daftar Kuis</h1>
        </div>
        <div class="card-body">
            @if(session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <!-- Form pencarian -->
            <form method="GET" action="{{ route('users.quis.index') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan judul" value="{{ request()->search }}">
                    <button class="btn btn-success" type="submit">Cari</button>
                </div>
            </form>
        
            <ul class="list-group">
                @foreach($materis as $materi)
                    <li class="list-group-item p-0 mb-2 border-0">
                        <a href="{{ route('users.quis.show', $materi->id) }}" class="btn btn-outline-success w-100 text-start d-flex align-items-center animated-item">
                            @if(in_array($materi->id, $completedQuizzes))
                                <i class="fas fa-check-circle me-2 text-success"></i>
                            @else
                                <i class="fas fa-question-circle me-2 text-danger"></i>
                            @endif
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
@endsection