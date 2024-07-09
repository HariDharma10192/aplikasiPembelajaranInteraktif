@extends('u_components.layout')

@section('content') 

{{-- <x-layout title="Materi 1"> --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-center text-white">Materi 1</h1>
    </div>
    <div class="pdf-container" style="border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden;">
        <iframe src="{{ url('storage/assetku/bab1.pdf') }}" width="100%" height="600px" style="border: none;"></iframe>
    </div>
    
    <a href="/" class="btn btn-primary mt-4">Kembali</a>


    @endsection