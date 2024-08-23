@extends('layouts.app')

@section('content')
    <style>
        /* Styling khusus untuk form */
        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            margin-bottom: 20px;
        }

        /* Styles for validation */
        .was-validated .form-control:valid {
            border-color: #28a745; /* Green for valid */
        }

        .was-validated .form-control:invalid {
            border-color: #dc3545; /* Red for invalid */
        }

        .was-validated .input-group-text:valid {
            border-color: #28a745; /* Green for valid */
        }

        .was-validated .input-group-text:invalid {
            border-color: #dc3545; /* Red for invalid */
        }
    </style>

    <form class="row g-3 needs-validation" action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('put')
        <div class="container mt-4">
            <div class="form-container">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="">
                                    <div class="mb-3">
                                        <label class="form-label">Upload Foto</label>
                                        <div class="input-group mb-3">
                                            <input type="file" name="foto_deskripsi" class="form-control @error('foto_deskripsi') is-invalid @enderror" id="inputGroupFile" onchange="previewImage(event)">
                                            <label class="input-group-text" for="inputGroupFile">Upload</label>
                                            @error('foto_deskripsi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Menampilkan gambar yang sudah ada -->
                                        <div class="mt-2">
                                            <img id="imagePreview" src="{{ $berita->foto_deskripsi ? asset('imageBerita/' . $berita->foto_deskripsi) : '' }}" alt="Preview" style="max-width: 200px; max-height: 200px; display: block;">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="col-md-6">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ $berita->judul }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5" >{{ $berita->deskripsi }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Upload Berita</label>

                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                                name="tanggal" value="{{ $berita->tanggal }}">


                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-primary mt-3 col-md-2" type="submit" name="submit">
                            Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>


    <script>
        // Function to preview image
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                output.style.display = 'block';
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // Event listener for file input change
        document.getElementById('inputGroupFile').addEventListener('change', function(event) {
            previewImage(event);
            var input = event.target;
            if (input.files && input.files.length > 0) {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            }
        });

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
