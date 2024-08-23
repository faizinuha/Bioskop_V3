@extends('layouts.app')

@section('search')
    <form action="{{ route('detail') }}" method="GET" class="d-flex">
        <input class="form-control me-2" type="search" name="search" placeholder="Cari judul film" aria-label="Search" required>
        <a class="btn btn-outline-primary" href="{{ route('detail') }}">Refresh</a>
    </form>
@endsection

@section('content')
    <style>
        .film-card {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            margin: 10px;
            border-radius: 10px;
            width: 150px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #007bff;
            color: white;
            font-size: 1.2rem;
        }

        .film-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .film-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            padding: 10px;
        }

        .modal-footer {
            display: flex;
            justify-content: space-between;
        }

        .kursi-card {
            width: 50px;
            height: 50px;
            background-color: #007bff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            margin: 5px;
        }

        .kursi-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
    </style>

@if (session('gagal'))
    <div class="toast-container mt-5 position-fixed top-0 end-0 p-3" style="z-index: 11">
        <div class="toast mt-3 align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('gagal') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'));
            var toastList = toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl, {
                    delay: 3000
                });
            });
            toastList.forEach(toast => toast.show());
        });
    </script>
@endif

@if (session('success'))
    <div class="toast-container mt-5 position-fixed top-0 end-0 p-3" style="z-index: 11">
        <div class="toast mt-3 align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'));
            var toastList = toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl, {
                    delay: 3000
                });
            });
            toastList.forEach(toast => toast.show());
        });
    </script>
@endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center text-secondary">Kursi Film</h1>

                <a href="{{ route('studio.create') }}" class="btn btn-primary mb-4">Tambah Studio</a>

                <div class="film-container">
                    @forelse ($studio as $item)
                        <div class="film-card" data-bs-toggle="modal" data-bs-target="#studioModal{{ $item->id }}">
                            <p>{{ $item->studio }}</p>
                        </div>

                        <!-- Studio Modal -->
                        <div class="modal fade" id="studioModal{{ $item->id }}" tabindex="-1" aria-labelledby="studioModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="studioModalLabel{{ $item->id }}">Detail Studio</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form Update Studio -->
                                        <form action="{{ route('studio.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="studioName" class="form-label">Nama Studio</label>
                                                <input type="text" class="form-control" id="studioName" name="studio" value="{{ $item->studio }}" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Edit Studio</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('studio.delete', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <p>Tidak ada studio</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
