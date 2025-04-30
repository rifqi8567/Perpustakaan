@extends('layouts.mazer')
@section('page-heading', 'Favorit')

@section('content')
<div class="container">
    <h1>Daftar Favorit</h1>
    @if(session('successMessage'))
        <div class="alert alert-success">
            {{ session('successMessage') }}
        </div>
    @elseif(session('errorMessage'))
        <div class="alert alert-danger">
            {{ session('errorMessage') }}
        </div>
    @endif
    <div class="row">
        @foreach ($favorit as $item)
            <div class="col-md-4">
                <div class="card">
                    @if($item->buku && $item->buku->upload_gambar)
                <img src="{{ asset('storage/' . $item->buku->upload_gambar) }}" class="card-img-top" alt="{{ $item->buku->judul_buku }}">
            @else
                <img src="{{ asset('storage/default-image.jpg') }}" class="card-img-top" alt="Gambar Tidak Tersedia">
            @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->buku ? $item->buku->judul_buku : 'Judul Tidak Tersedia' }}</h5>
                <p class="card-text">Penerbit: {{ $item->buku ? $item->buku->nama_penerbit : 'Penerbit Tidak Tersedia' }}</p>
                <p class="card-text">Tahun: {{ $item->buku ? $item->buku->tahun_diterbitkan : 'Tahun Tidak Tersedia' }}</p>
                          <!-- Wrapper untuk tombol -->
                          <div class="d-flex justify-content-between">
                            <!-- Tombol Detail -->
                            <a href="{{ route('detail.buku', $item->buku ? $item->buku->id : '#') }}" class="btn btn-primary">
                                Lihat Detail
                            </a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('favorit.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini dari favorit?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
