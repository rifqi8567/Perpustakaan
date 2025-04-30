@extends('layouts.mazer')

@section('page-heading', 'Edit Review')
@section('content')

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

<section>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Edit Review</h4>
                    </div>
                    <div class="card-body">
                        @if ($review)
                        <form action="{{ route('review.update', $review->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="review" class="form-label fw-bold">Review</label>
                                <textarea name="review" id="review" class="form-control" rows="5" placeholder="Tulis review Anda..." required>{{ old('review', $review->review) }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="rating" class="form-label fw-bold">Rating</label>
                                <select name="rating" id="rating" class="form-select" required>
                                    <option value="1" {{ old('rating', $review->rating) == 1 ? 'selected' : '' }}>1 - Sangat Buruk</option>
                                    <option value="2" {{ old('rating', $review->rating) == 2 ? 'selected' : '' }}>2 - Buruk</option>
                                    <option value="3" {{ old('rating', $review->rating) == 3 ? 'selected' : '' }}>3 - Cukup</option>
                                    <option value="4" {{ old('rating', $review->rating) == 4 ? 'selected' : '' }}>4 - Baik</option>
                                    <option value="5" {{ old('rating', $review->rating) == 5 ? 'selected' : '' }}>5 - Sangat Baik</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Update Review</button>
                            </div>
                        </form>
                        @else
                        <div class="alert alert-warning" role="alert">
                            Review tidak ditemukan.
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
