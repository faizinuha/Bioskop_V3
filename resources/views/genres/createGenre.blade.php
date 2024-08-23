@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="form-container">
        <h1 class="form-title text-center">Tambah Genre</h1>
        <form action="{{ route('genre.store') }}" method="POST" >
            @csrf
            <div class="mb-3">
                <label class="form-label">Genre</label>
                <input type="text" class="form-control @error('genre') is-invalid @enderror" id="genre"
                    name="genre" placeholder="Tambahkan Genre" value="{{ old('genre') }}">
                @error('genre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn btn-outline-primary mt-3 col-md-2 hover" type="submit" name="submit">
                <ion-icon name="add-circle-outline"></ion-icon>
            </button>
            <a href="{{route('genre')}}" class="btn btn-outline-danger mt-3 col-md-2 hover" ><ion-icon name="arrow-back-outline"></ion-icon></a>
        </form>
    </div>
</div>
<style>
    .hover:hover{
        cursor: pointer;
        text-decoration: underline;
        border-radius: 20px 27px;
    }
</style>
@endsection
