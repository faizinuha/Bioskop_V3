@extends('layouts.app')
@if (session('eror'))
<div class="toast-container mt-5 top-5 end-0 p-2" style="z-index: 11">
    <div class="toast mt-3 align-items-center text-bg-danger border-0 show slide-down" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('eror') }}
            </div>
        </div>
    </div>
</div>
@endif

@section('content')
<div class="container mt-4">
    <div class="form-container">
        <h1 class="form-title text-center">Tambah Waktu Tayang</h1>
        <form action="{{ route('time.store') }}" method="POST">
            @csrf


                <!-- Input Waktu Mulai -->
                <div class="mb-3">
                    <label class="form-label">Waktu Mulai</label>
                    <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror"
                           id="jam_mulai" name="jam_mulai"
                           value="{{ old('jam_mulai', '') }}">
                    @error('jam_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Waktu Selesai -->
                <div class="mb-3">
                    <label class="form-label">Waktu Selesai</label>
                    <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror"
                           id="jam_selesai" name="jam_selesai"
                           value="{{ old('jam_selesai', '') }}">
                    @error('jam_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>



                <button class="btn btn-primary mt-3" type="submit">
                    Tambah
                </button>
            </form>

    </div>
</div>
@endsection
