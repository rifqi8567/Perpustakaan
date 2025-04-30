@extends('layouts.mazer')

@section('page-heading', 'Pendaftaran')
@section('content')

<section id="multiple-column-form" class="mt-4">
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

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title mb-0">Form Pendaftaran</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('list.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" id="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="First Name" name="first_name" required>
                                @error('first_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" id="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name" name="last_name" required>
                                @error('last_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" id="city" class="form-control @error('city') is-invalid @enderror" placeholder="City" name="city" required>
                                @error('city')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="school" class="form-label">School</label>
                                <input type="text" id="school" class="form-control @error('school') is-invalid @enderror" name="school" placeholder="School" required>
                                @error('school')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="table1">
                    <thead class="table-primary">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>City</th>
                            <th>School</th>
                            <th>Email</th>
                            @if (auth()->user() && auth()->user()->role !== 'user')
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $pendaftaran)
                            <tr>
                                <td>{{ $pendaftaran->first_name }}</td>
                                <td>{{ $pendaftaran->last_name }}</td>
                                <td>{{ $pendaftaran->city }}</td>
                                <td>{{ $pendaftaran->school }}</td>
                                <td>{{ $pendaftaran->email }}</td>
                                @if (auth()->user() && auth()->user()->role !== 'user')
                                    <td>
                                        <div class="d-flex">
                                            <form action="{{ route('destroy.book', $pendaftaran->id) }}" method="POST" class="me-2">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                            </form>
                                            <a href="{{ route('edit.book', $pendaftaran->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
