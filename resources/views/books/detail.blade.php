@extends('layouts.mazer')

@section('page-heading', 'Detail Buku')
@section('content')

<!-- Flash Messages -->
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

<!-- Section Judul Buku -->
<div class="container mt-4">
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="card-title">{{ $data->judul_buku }}</h3>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5><strong>Judul:</strong> {{ $data->judul_buku }}</h5>
                    <h5><strong>Nama Penerbit:</strong> {{ $data->nama_penerbit }}</h5>
                    <h5><strong>Tahun Diterbitkan:</strong> {{ $data->tahun_diterbitkan }}</h5>
                    <h5><strong>Jumlah Halaman:</strong> {{ $data->jumlah_halaman }}</h5>
                </div>
                <div class="col-md-4 text-center">
                    <a href="{{ $data->upload_file }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary">
                        Buka File Buku
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section Ulasan Buku -->
<div class="container mt-4">
    <div class="card shadow border-0">
        <div class="card-header bg-secondary text-white text-center">
            <h5 class="card-title">Ulasan Buku</h5>
        </div>
        <div class="card-body">
            <!-- Looping over reviews -->
            @forelse ($data->reviews as $review)
                <div class="mb-4 border-bottom pb-3">
                    <p>
                        <strong>
                            @if ($review->user)
                                {{ $review->user->name }} (Rating: <span class="badge bg-warning text-dark">{{ $review->rating }}</span>)
                            @else
                                Pengguna tidak teridentifikasi (Rating: <span class="badge bg-warning text-dark">{{ $review->rating }}</span>)
                            @endif
                        </strong>
                    </p>
                    <p>{{ $review->review }}</p>
                    <p class="text-muted"><small>Ditulis pada {{ $review->created_at->format('d M Y, H:i') }}</small></p>

                    <!-- Action Buttons -->
                    @if (auth()->user() && (auth()->user()->id === $review->user_id || auth()->user()->role === 'admin'))
                        <a href="{{ route('review.edit', $review->id) }}" class="btn btn-warning btn-sm">Edit Review</a>
                    @endif

                    @if (auth()->user() && ($review->user_id === auth()->id() || auth()->user()->role === 'admin'))
                        <form action="{{ route('review.destroy', $review->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus review ini?')">Hapus</button>
                        </form>
                    @endif
                </div>
            @empty
                <p class="text-center">Belum ada ulasan untuk buku ini.</p>
            @endforelse

            <!-- Form untuk review baru -->
            @auth
                <div class="mt-4">
                    <h5>Tulis Review Anda</h5>
                    <form action="{{ route('review.store', $data->id) }}" method="POST" class="p-3 border rounded shadow-sm">
                        @csrf
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating (1-5)</label>
                            <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required>
                        </div>
                        <div class="mb-3">
                            <label for="review" class="form-label">Review</label>
                            <textarea name="review" id="review" class="form-control" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Kirim Review</button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</div>

@endsection
