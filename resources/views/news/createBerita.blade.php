@extends('layouts.app')

@section('content')
    <style>
        /* Styling khusus untuk form */
        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .form-title {
            margin-bottom: 20px;
        }

        .image-preview {
            max-width: 200px;
            max-height: 200px;
            display: none;
            border: 2px solid #ddd;
            border-radius: 8px;
            margin-top: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004b9b;
        }
    </style>
    <div class="container">
        <form class="row g-3 needs-validation" action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data"
            novalidate>
            @csrf
            <div class="form-container">
                <h2 class="form-title text-center text-secondary">Tambah Berita Film</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="foto_deskripsi" class="form-label">Upload Foto</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control @error('foto_deskripsi') is-invalid @enderror" id="inputGroupFile" name="foto_deskripsi" required>
                                        <label class="input-group-text" for="inputGroupFile">Upload</label>
                                    </div>
                                    <img id="imagePreview" class="image-preview" alt="Preview Gambar">
                                    @error('foto_deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}">
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5" >{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Upload Berita</label>

                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                                name="tanggal" value="{{ old('tanggal', '') }}">


                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-primary mt-3" type="submit">Tambah</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Function to preview image
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                output.style.display = 'block'; // Ensure image preview is visible
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // Event listener for file input change
        document.getElementById('inputGroupFile').addEventListener('change', previewImage);

        // JavaScript for Bootstrap form validation
        (function() {
            'use strict';

            var forms = document.querySelectorAll('.needs-validation');

            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
        })();
    </script>
@endsection
