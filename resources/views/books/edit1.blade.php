@extends('layouts.mazer')

@section('page-heading', 'Edit Buku')
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
            <form action="{{ route('update.buku', $data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="judul_buku">Judul Buku</label>
                    <input type="text" class="form-control" id="judul_buku" name="judul_buku" value="{{ $data->judul_buku }}" placeholder="Judul Buku" required>
                </div>

                <div class="form-group">
                    <label for="nama_penerbit">Nama Penerbit</label>
                    <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit" value="{{ $data->nama_penerbit }}" placeholder="Nama Penerbit" required>
                </div>

                <div class="form-group">
                    <label for="tahun_diterbitkan">Tahun Diterbitkan</label>
                    <input type="text" class="form-control" id="tahun_diterbitkan" name="tahun_diterbitkan" value="{{ $data->tahun_diterbitkan }}" placeholder="Tahun Diterbitkan" required>
                </div>

                <div class="form-group">
                    <label for="jumlah_halaman">Jumlah Halaman</label>
                    <input type="text" class="form-control" id="jumlah_halaman" name="jumlah_halaman" value="{{ $data->jumlah_halaman }}" placeholder="Jumlah Halaman" required>
                </div>
                <div class="form-group">
                    <label for="upload_file">Upload File</label>
                    <input type="text" class="form-control" id="upload_file" name="upload_file" value="{{ $data->upload_file }}" placeholder="Upload File" required>
                </div>
                <br>   
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
