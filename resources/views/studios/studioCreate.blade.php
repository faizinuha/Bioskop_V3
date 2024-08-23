@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="form-container bg-white p-5 rounded shadow-lg">
            <h1 class="form-title text-center text-secondary mb-4">Tambah Studio</h1>
            <form action="{{ route('studio.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="studio" class="form-label font-weight-bold text-gray-700 warna">Studio:</label>
                    <input type="text" class="form-control @error('studio') is-invalid @enderror" id="studio"
                        name="studio" placeholder="Tambahkan studio" value="{{ old('studio') }}">
                    @error('studio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="seats" class="form-label font-weight-bold text-gray-700 text-center">Pilih Kursi:</label>
                    <div class="kursi-container d-flex flex-wrap gap-4 mt-2">
                        @foreach ($kursi->skip(9)->chunk(5) as $chunk)
                            <div class="row mb-3">
                                @foreach ($chunk as $seat)
                                    <div class="col">
                                        <div class="card kursi-seat d-flex align-items-center justify-content-center">
                                            <input type="checkbox" id="seat-{{ $seat->id }}" name="kursis[]"
                                                value="{{ $seat->id }}" class="form-check-input mr-2"
                                                {{ in_array($seat->id, old('kursis', [])) ? 'checked' : '' }}>
                                            <label for="seat-{{ $seat->id }}" class="form-check-label text-gray-600">
                                                 {{ $seat->label }} <br>  {{ $seat->kursi }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-outline-primary mt-3" id="select-all">Pilih Semua Kursi</button>
                    <button type="reset" class="btn btn-outline-danger mt-3">Reset</button>
                    @error('id_kursi')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <button class="btn btn-outline-primary px-4 py-2 rounded-pill" type="submit" name="submit">
                        <ion-icon name="add-circle-outline"></ion-icon> Tambah
                    </button>
                    <a href="{{ route('studio') }}" class="btn btn-outline-danger px-4 py-2 rounded-pill">
                        <ion-icon name="arrow-back-outline"></ion-icon> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

    <style>
       .text-center {
    text-align: center;
    display: block;
    width: 100%; /* Pastikan label mengisi lebar container */
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

        .btn-outline-primary,
        .btn-outline-danger {
            border-radius: 20px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-outline-primary {
            border-color: #007bff;
            color: #007bff;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #fff;
        }

        .btn-outline-danger {
            border-color: #dc3545;
            color: #dc3545;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .invalid-feedback {
            font-size: 0.875rem;
        }

        .kursi-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;

        }

        .kursi-seat {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 50px;
            height: 50px;
            /* Adjust width as needed */
            padding: 10px;
            border: 1px solid #100375;
            background-color: #9ea4af;
            border-radius: 8px;
        }


        .form-check-input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .form-check-label {
            display: block;
            cursor: pointer;
            color: #faf7f7;
        }
        .form-check-input:checked+.form-check-label {
            color: #01060a;
            font-weight: bold;
        }
    </style>

    <script>
        document.getElementById('select-all').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.form-check-input');
            checkboxes.forEach(checkbox => checkbox.checked = true);
        });
    </script>
@endsection
