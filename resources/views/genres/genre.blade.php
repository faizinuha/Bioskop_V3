@extends('layouts.app')

@section('search')
<form action="{{ route('genre') }}" class="d-flex mx-auto" method="get">
    <input class="form-control me-2" type="search" name="search" placeholder="Cari judul film" aria-label="Search" required>
    <a class="btn btn-outline-success" href="{{ route('genre') }}">Refresh</a>
</form>
@endsection

@section('content')

@if (session('success'))
    <div class="toast-container position-fixed top-5 end-0 p-2" style="z-index: 11">
        <div class="toast align-items-center text-bg-success border-0 show slide-down" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>
@endif

@if (session('delete'))
    <div class="toast-container position-fixed top-5 end-0 p-2" style="z-index: 11">
        <div class="toast align-items-center bg-danger text-white border-0 show slide-down" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('delete') }}
                </div>
            </div>
        </div>
    </div>
@endif

<style>
    .pos {
        text-align: center;
        max-width: 300px;
        margin: 0 auto;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
    }

    .warning {
        color: white;
        transition: 2s ease;
        position: relative;
        overflow: hidden;
    }

    .warning::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 0;
        width: 0;
        height: 2px;
        transition: all 0.3s;
    }

    .warning:hover::after {
        background-color: red;
        left: 0;
        width: 100%;
    }

    .btn-create,
    .btn-edit,
    .btn-delete {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        margin: 10px;
        border-radius: 20px;
        cursor: pointer;
        font-size: 0.9rem;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-create:hover,
    .btn-edit:hover,
    .btn-delete:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .btn-create {
        margin-bottom: 20px;
    }

    .btn-edit {
        background-color: #28a745;
    }

    .btn-edit:hover {
        background-color: #218838;
    }

    .btn-delete {
        background-color: #dc3545;
    }

    .btn-delete:hover {
        background-color: #c82333;
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

<div class="container mt-4">
    <div class="">
        <a class="btn btn-primary btn-create" href="{{ route('genre.create') }}">
           Tambah Genre
        </a>
    </div>
    <div class="container mt-4">
        <div class="card mt-4">
            <div class="card-header">
                <h3>{{ __('Daftar Genre') }}</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="GO" width="100%" cellspacing="0">
                        <thead class="table-primary">
                            <tr>

                                {{-- <th class="text-center">No</th> --}}
                                <th class="text-center">Genre</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($genre as $item)
                                <tr>
                                    {{-- <td class="col">{{ $loop->iteration }}</td> --}}
                                    <td class="col">{{ $item->genre }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('genre.edit', $item->id) }}" class="btn btn-success btn-sm">
                                            <ion-icon name="pencil-outline"></ion-icon>
                                        </a>
                                        <!-- Modal Trigger -->
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </button>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                       Apa Kamu Yakin Ingin Menghapus Genre?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ route('genre') }}"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button></a>

                                                        <form action="{{ route('genre.delete', $item->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                <ion-icon name="trash-outline"></ion-icon> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Delete Modal -->
                </div>
            </div>
        </div>
    </div>
</div>

@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">
@endpush
@push('script')
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
@endpush

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let table = new DataTable('#GO');
        setTimeout(function() {
            var toastElList = document.querySelectorAll('.toast');
            toastElList.forEach(function(toastEl) {
                var toast = new bootstrap.Toast(toastEl, {
                    autohide: true,
                    delay: 2000
                });
                toast.show();

                setTimeout(function() {
                    toastEl.classList.add('fade-out');
                }, 2000);
            });
        }, 2000);
    });
</script>
@endsection
