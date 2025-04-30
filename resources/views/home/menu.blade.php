@extends('layouts.mazer')

@section('page-heading', 'Dashboard')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-info rounded-lg overflow-hidden">
                <div class="card-header text-center bg-gradient text-white">
                    <h2 class="font-amiri">بِسْــــــــــــــــــمِ اللهِ الرَّحْمَنِ الرَّحِيْمِ</h2>
                </div>
                <div class="card-body">
                    <h3 class="text-right text-primary" style="font-family: 'Amiri', serif;">Assalamu'alaikum Warahmatullahi Wabarakatuh</h3>
                    <h5 class="text-right text-muted mb-4" style="font-family: 'Amiri', serif;">Selamat datang di halaman ini!</h5>
                    <hr class="mb-4">
                    <div class="d-flex justify-content-center mb-4">
                        <a href="{{ route('list') }}" class="btn btn-lg btn-outline-info shadow-lg px-4 py-2 font-roboto border-0 rounded-pill hover-scale">
                            <i class="bi bi-book"></i> Perpustakaan
                        </a>                           
                    </div>
                    <div class="d-flex justify-content-center">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-lg btn-danger shadow-lg px-4 py-2 font-roboto border-0 rounded-pill hover-scale">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    body {
        background: linear-gradient(to right, #e0f7fa, #b2ebf2);
        font-family: 'Arial', sans-serif;
    }
    .card {
        border-radius: 20px;
        overflow: hidden;
        border: none;
    }
    .card-header {
        background: linear-gradient(to right, #2d5f8b, #1d4f6e);
        border-bottom: 3px solid #1d4f6e;
        padding: 20px;
    }
    .card-body {
        padding: 20px;
        background: #ffffff;
    }
    .btn-outline-info {
        border-color: #1d4f6e;
        color: #1d4f6e;
        font-weight: 600;
        transition: all 0.3s ease-in-out;
        text-transform: uppercase;
    }
    .btn-outline-info:hover {
        background-color: #1d4f6e;
        color: #ffffff;
        transform: scale(1.05);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }
    .btn-danger {
        background-color: #e63946;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease-in-out;
    }
    .btn-danger:hover {
        background-color: #c92c2c;
        transform: scale(1.05);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }
    .rounded-lg {
        border-radius: 15px;
    }
    .font-amiri {
        font-family: 'Amiri', serif;
    }
    .font-roboto {
        font-family: 'Roboto', sans-serif;
    }
    .hover-scale {
        transition: transform 0.3s;
    }
    .hover-scale:hover {
        transform: scale(1.05);
    }
    .shadow-lg {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }
    .bi {
        margin-right: 8px;
    }
</style>
@endsection
