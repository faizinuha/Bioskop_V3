@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="form-container">
            <h1 class="form-title text-center text-secondary">Edit kursi</h1>
            <form action="{{ route('kursi.update', $kursi->id) }}" method="POST">
                @csrf
                @method('put')

                <div class="col-md-6">
                    <label class="form-label">Studio</label>
                    <select class="mt-3 form-select @error('id_studio') is-invalid @enderror"
                            aria-label="Select Payment Method" name="id_studio">
                        <option selected disabled>Pilih Studio</option>
                        @foreach ($studio as $item)
                            <option value="{{ $item->id }} "@if ($item->id == $kursi->id_studio) selected @endif>{{ $item->studio }}</option>
                        @endforeach
                    </select>
                    @error('id_studio')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah Kursi</label>
                    <input type="text" class="form-control @error('kursi') is-invalid @enderror" id="kursi"
                        name="kursi" value="{{ ($kursi->kursi) }}">
                    @error('kursi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-outline-primary mt-3 col-md-2 hover" type="submit" name="submit">
                    <ion-icon name="add-circle-outline"></ion-icon>
                </button>
                <a href="{{ route('kursi.index') }}" class="btn btn-outline-danger mt-3 col-md-2 hover">
                    <ion-icon name="arrow-back-outline"></ion-icon>
                </a>
            </form>
        </div>
    </div>
@endsection
