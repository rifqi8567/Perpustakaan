@extends('layouts.mazer')

@section('page-heading', 'Data Buku')
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
            <form action="{{route('create.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="form-group"> @error('judul_buku')
                <span class="text-danger">{{ $message }}</span>
            @enderror
                <label for="judul_buku">Judul Buku</label>
                <input type="text" class="form-control" id="judul_buku" name="judul_buku" placeholder="Masukkan Judul Buku">
            </div>
            <br>
            <div class="form-group">
                @error('nama_penerbit')
                <span class="text-danger">{{ $message }}</span>
            @enderror
                <label for="nama_penerbit">Nama Penerbit</label>
                <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit" placeholder="Masukkan Nama Penerbit">
            </div>
            <br>
            <div class="form-group">
                @error('tahun_diterbitkan')
                <span class="text-danger">{{ $message }}</span>
            @enderror
                <label for="tahun_diterbitkan">Tahun di Terbitkan</label>
                <input type="text" class="form-control" id="tahun_diterbitkan" name="tahun_diterbitkan" placeholder="Masukkan Tahun di Penerbit">
            </div>
            <br>
            <div class="form-group">
                @error('jumlah_halaman')
                <span class="text-danger">{{ $message }}</span>
            @enderror
                <label for="jumlah_halaman">Jumlah Halaman</label>
                <input type="text" class="form-control" id="jumlah_halaman"  name="jumlah_halaman" placeholder="Masukkan Jumlah Halaman">
            </div>
            <div class="form-group">
                @error('upload_file')
                <span class="text-danger">{{ $message }}</span>
            @enderror
                <label for="upload_file"> File</label>
                <input type="text" class="form-control" id="upload_file"  name="upload_file" placeholder="Masukkan File">
            </div>
           <br>
            <div class="form-group">
                @error('upload_gambar')
                <span class="text-danger">{{ $message }}</span>
            @enderror
                <label for="upload_gambar">Upload Gambar</label>
                <input type="file" class="form-control" id="upload_gambar"  name="upload_gambar" placeholder="Masukkan Jumlah Halaman">
            </div>
        </div>
        <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary me-1 mb-1 w-100">Submit</button>
        </div>
        </form>
        </div>
    </div>
</div>




@endsection