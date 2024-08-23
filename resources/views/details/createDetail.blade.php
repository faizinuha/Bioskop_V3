@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4 text-secondary">Tambah Film</h1>
        <form class="row g-3 needs-validation" action="{{ route('detail.store') }}" method="POST" enctype="multipart/form-data"
            novalidate>
            @csrf

            <div class="col-md-6">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul"
                    value="{{ old('judul') }}" required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if (old('judul') && !$errors->has('judul'))
                    <div class="valid-feedback">Terlihat baik!</div>
                @endif
            </div>

            <div class="col-md-6 mt-5">
                <label class="form-label">Genre:</label>
                @foreach ($genre as $item)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('genres') is-invalid @enderror" type="checkbox"
                            name="genres[]" value="{{ $item->id }}" id="genre-{{ $item->id }}"
                            {{ is_array(old('genres')) && in_array($item->id, old('genres')) ? 'checked' : '' }}>
                        <label class="form-check-label" for="genre-{{ $item->id }}">{{ $item->genre }}</label>
                    </div>
                @endforeach
                @error('genres')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if (is_array(old('genres')) && !$errors->has('genres'))
                    <div class="valid-feedback">Terlihat baik!</div>
                @endif
            </div>

            <div class="col-md-6">
                <label for="tanggalRilis" class="form-label">Tanggal Rilis</label>
                <input type="date" class="form-control @error('tanggalRilis') is-invalid @enderror" id="tanggalRilis"
                    name="tanggalRilis" value="{{ old('tanggalRilis') }}" required>
                @error('tanggalRilis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if (old('tanggalRilis') && !$errors->has('tanggalRilis'))
                    <div class="valid-feedback">Terlihat baik!</div>
                @endif
            </div>

            <div class="col-md-6">
                <label for="pemeran" class="form-label">Pemeran</label>
                <input type="text" class="form-control @error('pemeran') is-invalid @enderror" id="pemeran"
                    name="pemeran" value="{{ old('pemeran') }}" required>
                @error('pemeran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if (old('pemeran') && !$errors->has('pemeran'))
                    <div class="valid-feedback">Terlihat baik!</div>
                @endif
            </div>

            <div class="col-md-6">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis"
                    name="penulis" value="{{ old('penulis') }}" required>
                @error('penulis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if (old('penulis') && !$errors->has('penulis'))
                    <div class="valid-feedback">Terlihat baik!</div>
                @endif
            </div>

            <div class="col-md-6">
                <label for="sutradara" class="form-label">Sutradara</label>
                <input type="text" class="form-control @error('sutradara') is-invalid @enderror" id="sutradara"
                    name="sutradara" value="{{ old('sutradara') }}" required>
                @error('sutradara')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if (old('sutradara') && !$errors->has('sutradara'))
                    <div class="valid-feedback">Terlihat baik!</div>
                @endif
            </div>

            <div class="col-md-6">
                <label for="perusahaanProduksi" class="form-label">Perusahaan Produksi</label>
                <input type="text" class="form-control @error('perusahaanProduksi') is-invalid @enderror"
                    id="perusahaanProduksi" name="perusahaanProduksi" value="{{ old('perusahaanProduksi') }}" required>
                @error('perusahaanProduksi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if (old('perusahaanProduksi') && !$errors->has('perusahaanProduksi'))
                    <div class="valid-feedback">Terlihat baik!</div>
                @endif
            </div>

            <div class="col-md-6">
                <label for="harga" class="form-label">Harga Tiket</label>
                <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga"
                    name="harga" value="{{ old('harga') }}" required>
                @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if (old('harga') && !$errors->has('harga'))
                    <div class="valid-feedback">Terlihat baik!</div>
                @endif
            </div>

            <div class="col-md-6">
                <label class="form-label">Jam Tayang</label>
                <select class="mt-3 form-select @error('id_time') is-invalid @enderror" name="id_time" required>
                    <option selected disabled>Pilih Jam Tayang</option>
                    @foreach ($time as $item)
                        <option value="{{ $item->id }}" {{ old('id_time') == $item->id ? 'selected' : '' }}>
                            {{ $item->jam_mulai }} - {{ $item->jam_selesai }}</option>
                    @endforeach
                </select>
                @error('id_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if (old('id_time') && !$errors->has('id_time'))
                    <div class="valid-feedback">Terlihat baik!</div>
                @endif
            </div>

            <div class="col-md-6">
                <label class="form-label">Tanggal Tayang</label>
                <select class="mt-3 form-select @error('id_tanggal') is-invalid @enderror" name="id_tanggal" required>
                    <option selected disabled>Pilih Tanggal Tayang</option>
                    @foreach ($tanggal as $item)
                        <option value="{{ $item->id }}" {{ old('id_tanggal') == $item->id ? 'selected' : '' }}>
                            {{ strftime('%d, %B, %Y', strtotime($item->tanggal_mulai)) }}</option>
                    @endforeach
                </select>
                @error('id_tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if (old('id_tanggal') && !$errors->has('id_tanggal'))
                    <div class="valid-feedback">Terlihat baik!</div>
                @endif
            </div>

            <div class="col-md-6">
                <label class="form-label">Studio</label>
                <select class="mt-3 form-select @error('id_studio') is-invalid @enderror" name="id_studio" required>
                    <option selected disabled>Pilih Studio</option>
                    @foreach ($studio as $item)
                        <option value="{{ $item->id }}" {{ old('id_studio') == $item->id ? 'selected' : '' }}>
                            {{ $item->studio }}</option>
                    @endforeach
                </select>
                @error('id_studio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if (old('id_studio') && !$errors->has('id_studio'))
                    <div class="valid-feedback">Terlihat baik!</div>
                @endif
            </div>

            <div class="col-12">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                    rows="5" required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if (old('deskripsi') && !$errors->has('deskripsi'))
                    <div class="valid-feedback">Terlihat baik!</div>
                @endif
            </div>

            <div class="col-12">
                <label for="foto" class="form-label">Poster</label>
                <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto"
                    name="foto" value="{{ old('foto') }}" onchange="previewImage(event)"  required>
                <img id="imagePreview" class="mt-2 suggets" style="max-width: 200px; max-height: 200px; display: none;">
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if (old('foto') && !$errors->has('foto'))
                    <div class="valid-feedback">Terlihat baik!</div>
                @endif
            </div>

            <div class="col-12">
                <button class="btn btn-success mt-4" style="background-color: blue; border-radius:30px;" type="submit">Submit form</button>
            </div>
        </form>
        <style>
            .suggets{
                border: 3px solid blue;
            }
        </style>
        <script>
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
    </div>
@endsection
