@extends('layouts.mazer')
@section('page-heading', 'Form Lomba')

@section('content')
<div class="container mt-4">
    @if (session('successMessage'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('successMessage') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('errorMessage'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('errorMessage') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Lomba</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('update.lomba', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $data->judul }}" placeholder="Masukkan Judul" required>
                </div>

                <div class="mb-3">
                    <label for="subtitle" class="form-label">Subtitle</label>
                    <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ $data->subtitle }}" placeholder="Masukkan Subtitle" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi" required rows="4">{{ $data->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="kuotes" class="form-label">Kuotes</label>
                    <input type="text" class="form-control" id="kuotes" name="kuotes" value="{{ $data->kuotes }}" placeholder="Masukkan Kuotes" required>
                </div>

                <div class="mb-3">
                    <label for="hadiah" class="form-label">Hadiah</label>
                    <input type="text" class="form-control" id="hadiah" name="hadiah" value="{{ $data->hadiah }}" placeholder="Masukkan Hadiah" required>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
