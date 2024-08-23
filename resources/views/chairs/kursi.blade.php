@extends('layouts.app')

@section('content')
    <style>
        * {
            scroll-behavior: smooth;
            font-family: Arial, sans-serif;
        }

        .seat-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 10px;
        }

        .seat-row {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .seat-card {
            background-color: #3498db;
            color: white;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            width: 40px;
            height: 40px;
            line-height: 30px;
            font-size: 14px;
        }

        .seat-card:hover {
            background-color: #2980b9;
            transform: scale(1.05);
        }

        .toast-container {
            max-width: 300px;
        }

        .slide-down {
            animation: slide-down 2s ease 0s 1 normal forwards;
        }

        @keyframes slide-down {
            from {
                transform: translateZ(-9.7rem);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .fade-out {
            animation: fade-out 1s ease forwards;
        }

        @keyframes fade-out {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
                transform: translateY(-10px);
            }
        }
    </style>


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
        <h1 class="text-center text-secondary small">Daftar Kursi</h1>
        <a href="{{ route('kursi.create') }}" class="btn btn-primary mb-4 rounded">Tambah Kursi</a>
        {{-- atur sesuka anda ingin berapa baris dan skin berapa  --}}
        <div class="seat-container">
            @foreach ($kursi->skip(6)->chunk(6) as $seatChunk)
                <div class="seat-row">
                    @foreach ($seatChunk as $seat)
                        <div class="seat-card">
                            {{ $seat->kursi }}
                        </div>
                    @endforeach
                </div>
            @endforeach

        </div>

        <a href="{{ route('home') }}"
            class="btn btn-secondary btn-back mt-4 d-flex justify-content-center align-items-center">Back to Home</a>
    </div>
@endsection
