@extends('u_components.layout')

@section('content') 
    <div class="card bg-secondary rounded-lg">
        <div class="card-title"> 
            <p class="p-2 text-center bg-warning  w-100 text-capitalize display-4 ">{{auth() -> user() -> username}}</p>
        </div>

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center p-2 bg-light">
                <span class="">Nilai Materi 1</span>
                <span class="w-25 text-center bg-info">80</span>
            </div>
            <br>
            <div class="d-flex justify-content-between align-items-center p-2 bg-light">
                <span class="">Nilai Materi 2</span>
                <span  class="w-25 text-center bg-info">80</span>
            </div>
            <br>
            <div class="d-flex justify-content-between align-items-center p-2 bg-light">
                <span>Nilai Evaluasi</span>
                <span  class="w-25 text-center bg-info">160</span>
            </div>
        </div>
    </div>
    <a href="/" class="btn btn-primary mt-4">Kembali</a>
@endsection