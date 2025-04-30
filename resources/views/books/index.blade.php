@extends('layouts.mazer')

@section('page-heading', 'Perpustakaan  ')
@section('content')

<div class="container">
    @if (session('successMessage'))
    <div class="alert alert-success">{{ session('successMessage') }}</div>
@endif
@if (session('errorMessage'))
    <div class="alert alert-danger">{{ session('errorMessage') }}</div>
@endif
    <div class="card">
        <div class="card-body">
            <h2 style="text-align: center">بِسْــــــــــــــــــمِ اللهِ الرَّحْمَنِ الرَّحِيْمِ</h2>
            <br>
            <h3 style="text-align: right">السلام عليكم ورحمة الله وبركاته</h3>
            <h5 style="text-align: right">أهلا و سهلا و مرحبا</h5>
            <br>
            <p>Selamat Datang Diperpustakaan Islamic Center</p>
            <br>
            <h6>"Gerbang Ilmu Pengetahuan Ada di Sini!"</h6>
            <p>Perpustakaan kami hadir untuk mendukung perjalanan belajar Anda dengan koleksi lengkap, layanan terbaik, dan teknologi terkini. Jelajahi dunia literasi bersama kami.            </p>
            <br><br>
            <h5 style="text-align: center">طَلَبُ الْعِلْمِ فَرِيْضَةٌ عَلَى كُلِّ مُسْلِمٍ</h5>
            <p style="text-align: center">Menuntut ilmu itu wajib atas setiap Muslim</p>
        </div>
    </div>
</div>         
      
@foreach ($data as $item)
<div class="container">


    <div class="card">
        <div class="card-body">
            <h2 style="text-align: center">{{ $item->judul }}</h2>
            <h4 style="text-align: center">{{ $item->subtitle }}</h4>
            <p style="text-align: center">{{ $item->deskripsi }}</p>
             <h6 style="text-align: center">{{ $item->kuotes }}</h6>   
             <p style="text-align: center">{{ $item->hadiah }}</p>
             <div class="d-flex justify-content-center">
                 <a href="{{ route('book') }}" class=" btn btn-danger " >Daftar</a>
             </div>

            <br>

            <h5 style="text-align: center">وَمَنْ سَلَكَ طَرِيقًا يَلْتَمِسُ فِيهِ عِلْمًا سَهَّلَ اللَّهُ لَهُ بِهِ طَرِيقًا إِلَى الْجَنَّةِ</h5>

            <p style="text-align: center">“Siapa yang menempuh jalan untuk mencari ilmu, maka Allah akan mudahkan baginya jalan menuju surga.”</p>
            @if (auth()->user() && auth()->user()->role !== 'user') 
            <div class="d-flex flex-row flex-wrap gap-5">
                <!-- Link ke halaman edit -->
                <a href="{{ route("edit.lomba", $item->id) }}" class="btn btn-warning">Edit</a>
            </div>
            @endif

        </div>
    </div>
</div>
@endforeach




@endsection