@extends('layouts.mazer')

@section('page-heading', 'Edit Pendaftaran')
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
            <form action="{{ route('update.book', $data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $data->first_name }}" placeholder="Masukkan Nama Depan" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $data->last_name }}" placeholder="Masukkan Nama Belakang" required>
                </div>

                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ $data->city }}" placeholder="Masukkan Kota" required>
                </div>

                <div class="form-group">
                    <label for="school">School</label>
                    <input type="text" class="form-control" id="school" name="school" value="{{ $data->school }}" placeholder="Masukkan Sekolah" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}" placeholder="Masukkan Email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{ $data->password }}" placeholder="Masukkan Password (Opsional)">
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
