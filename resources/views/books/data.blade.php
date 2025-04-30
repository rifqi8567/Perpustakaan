@extends('layouts.mazer')

@section('page-heading', 'Buku-Buku Islamic')
@section('content')

<section>
    <div class="container mt-4">
        <!-- Filter Section -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-gradient-primary text-white">
                <h4 class="mb-0">Filter dan Sortir Buku</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('data.buku') }}" method="GET">
                    <div class="row gy-3">
                        <!-- Search Field -->
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Cari judul, penerbit, atau tahun..." value="{{ $searchQuery ?? '' }}">
                        </div>

                        <!-- Tahun Filter -->
                        <div class="col-md-3">
                            <select name="tahun" class="form-select">
                                <option value="">-- Pilih Tahun --</option>
                                @foreach ($tahunOptions as $tahun)
                                    <option value="{{ $tahun }}" {{ $tahunFilter == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Penerbit Filter -->
                        <div class="col-md-3">
                            <select name="penerbit" class="form-select">
                                <option value="">-- Pilih Penerbit --</option>
                                @foreach ($penerbitOptions as $penerbit)
                                    <option value="{{ $penerbit }}" {{ $penerbitFilter == $penerbit ? 'selected' : '' }}>{{ $penerbit }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sortir Field -->
                        <div class="col-md-2">
                            <select name="sort" class="form-select">
                                <option value="">-- Urutkan --</option>
                                <option value="judul_buku_asc" {{ request('sort') == 'judul_buku_asc' ? 'selected' : '' }}>Judul (A-Z)</option>
                                <option value="judul_buku_desc" {{ request('sort') == 'judul_buku_desc' ? 'selected' : '' }}>Judul (Z-A)</option>
                                <option value="tahun_asc" {{ request('sort') == 'tahun_asc' ? 'selected' : '' }}>Tahun (Terlama)</option>
                                <option value="tahun_desc" {{ request('sort') == 'tahun_desc' ? 'selected' : '' }}>Tahun (Terbaru)</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary" type="submit">Filter & Sortir</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Filter Results -->
        @if (request('sort'))
            <p class="text-muted mt-3">Hasil sortir berdasarkan:
                @if (request('sort') == 'judul_buku_asc') Judul (A-Z)
                @elseif (request('sort') == 'judul_buku_desc') Judul (Z-A)
                @elseif (request('sort') == 'tahun_asc') Tahun (Terlama)
                @elseif (request('sort') == 'tahun_desc') Tahun (Terbaru)
                @endif
            </p>
        @endif

        <!-- Alerts -->
        @if (session('successMessage'))
            <div class="alert alert-success mt-3">{{ session('successMessage') }}</div>
        @endif
        @if (session('errorMessage'))
            <div class="alert alert-danger mt-3">{{ session('errorMessage') }}</div>
        @endif

        <!-- Book Cards -->
        <div class="row mt-4">
            @if ($data->isEmpty())
                <p class="text-center">Tidak ada data yang ditemukan.</p>
            @else
                @foreach ($data as $item)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="{{ asset('storage/' . $item->upload_gambar) }}" class="card-img-top" alt="Gambar Buku" style="object-fit: cover; height: 300px;">
                            <div class="card-body">
                                <h5 class="card-title text-truncate">{{ $item->judul_buku }}</h5>
                                <p class="card-text text-muted">Penerbit: {{ $item->nama_penerbit }}</p>
                                <p class="card-text text-muted">Tahun: {{ $item->tahun_diterbitkan }}</p>
                                <p class="card-text text-muted">Halaman: {{ $item->jumlah_halaman }}</p>
                                <p class="card-text text-warning">Rating: {{ $item->reviews()->avg('rating') ? number_format($item->reviews()->avg('rating'), 1) : 'Belum ada rating' }}</p>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('detail.buku', $item->id) }}" class="btn btn-primary btn-sm">Detail</a>
                                    <a href="{{ route('favorit.add', $item->id) }}" class="btn btn-outline-secondary btn-sm">Favorit</a>
                                </div>
                                @if (auth()->user() && auth()->user()->role !== 'user')
                                    <div class="d-flex justify-content-between mt-2">
                                        <form action="{{ route('create.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                                        </form>
                                        <a href="{{ route('edit.buku', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Favorite Books Section -->
       
    </div>
</section>

@endsection
