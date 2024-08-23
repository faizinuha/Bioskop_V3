@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="form-container">
            <h1 class="form-title text-center text-secondary">Tambah Kursi</h1>
            <form action="{{ route('kursi.store') }}" method="POST">
                @csrf
               
                <div class="mb-3">
                    <label for="kursi" class="form-label">Jumlah Kursi:</label>
                    <input type="text"class="form-control @error('kursi') is-invalid @enderror" id="kursi" name="kursi" placeholder="Tambahkan jumlah kursi" value="{{ old('kursi') }}">
                    @error('kursi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex">
                    <button class="btn btn-outline-primary mt-3 col-md-2 hover" type="submit" name="submit">
                        <ion-icon name="add-circle-outline"></ion-icon>
                    </button>
                    <a href="{{ route('kursi.index') }}" class="btn btn-outline-danger mt-3 col-md-2 hover">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </a>
                </div>
            </form>
        </div>
    </div>
    <style>
        .hover:hover {
            cursor: pointer;
            text-decoration: underline;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 1rem;
        }

        .btn-outline-primary {
            border-color: #007bff;
            color: #007bff;
            border-radius: 20px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #fff;
        }

        .btn-outline-danger {
            border-color: #dc3545;
            color: #dc3545;
            border-radius: 20px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .invalid-feedback {
            font-size: 0.875rem;
        }
    </style>
@endsection
