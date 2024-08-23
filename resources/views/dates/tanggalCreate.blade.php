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
            <h1 class="form-title text-center">Tambah Tanggal Tayang</h1>
            <form action="{{ route('tanggal.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Tanggal Tayang</label>

                    <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai"
                        name="tanggal_mulai" value="{{ old('tanggal_mulai', '') }}">


                    @error('tanggal_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{--  <div class="mb-3">
                    <label class="form-label">Tanggal Selesai</label>

                    <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" id="tanggal_selesai"
                        name="tanggal_selesai" value="{{ old('tanggal_selesai', '') }}">


                    @error('tanggal_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>  --}}

                <button class="btn btn-primary mt-3 col-md-2" type="submit" name="submit">
                    Tambah
                </button>
            </form>
        </div>
    </div>
@endsection
