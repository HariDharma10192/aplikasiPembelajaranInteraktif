@extends('u_components.layout')

@section('content')
    <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item"><a class="page-link" href="#">Sebelumnya</a></li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">4</a></li>
          <li class="page-item"><a class="page-link" href="#">5</a></li>
          <li class="page-item"><a class="page-link" href="#">6</a></li>
          <li class="page-item"><a class="page-link" href="#">7</a></li>
          <li class="page-item"><a class="page-link" href="#">8</a></li>
          <li class="page-item"><a class="page-link" href="#">9</a></li>
          <li class="page-item"><a class="page-link" href="#">10</a></li>
          <li class="page-item"><a class="page-link" href="#">Selanjutnya</a></li>
        </ul>
      </nav>
        <div class="card p-5">
            <p>Ciri-ciri khusus yang dimiliki tumbuhan yang hidup di air adalah ....</p>
            <ul>
                <li>A. Permukaan Daunya Lebar</li>
                <li>B. Batangnya Menggembung</li>
                <li>C. Batangnya Memiliki Rongga Udara</li>
                <li>D. Akarnya merupakan akar gantung</li>
            </ul>
            <form action="/submit" method="POST">   
                @csrf
                {{-- make a multiselect using boostrap --}}
                <div class="d-flex gap-5"><select name="answer" class="form-select" aria-label="Default select example">
                    <option selected>Pilih Jawaban Kamu</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
                <input type="submit" value="Submit" class="btn btn-success"></div>
            </form>

    </div>
    <a href="/" class="btn btn-primary mt-4">Kembali</a></a>
@endsection