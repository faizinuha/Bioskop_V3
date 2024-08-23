@extends('layouts.app')

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
            <div class="toast align-items-center text-bg-success border-0 show slide-down" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('delete') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('gagal'))
    <div class="toast-container position-fixed top-5 end-0 p-2" style="z-index: 11">
        <div class="toast align-items-center text-bg-danger border-0 show slide-down" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('gagal') }}
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
            position: relative;
            display: inline-block;
            padding: 10px 20px;
            border: 1px solid #ccc;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .warning:hover::after {
            width: 100%;
            left: 0;
            background-color: red;
        }

        .toast-container {
            max-width: 300px;
        }

        .slide-down {
            animation: slide-down 0.5s ease 0s 1 normal forwards;
        }

        @keyframes slide-down {
            from {
                transform: translateY(-50px);
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
        <div class="d-flex mb-4">
            <a class="btn btn-primary warning" href="{{ route('time.create') }}">
                <i class="fas fa-plus"></i> Tambah Waktu Tayang
            </a>
        </div>
        <div class="card text-center">
            <div class="card-header">
                <h3>{{ __('Daftar Jam Tayang') }}</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="table-primary">
                            <tr>

                                <th class="text-center">Jam Mulai</th>
                                <th class="text-center">Jam Berakhir</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($time as $item)
                                <tr>

                                    <td class="text-center">{{ date('H:i', strtotime($item->jam_mulai)) }}</td>
                                    <td class="text-center">{{ date('H:i', strtotime($item->jam_selesai)) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('time.edit', $item->id) }}" class="btn btn-success">
                                            <ion-icon name="pencil-outline"></ion-icon>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </button>
                                    </td>
                                </tr>


                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apa Kamu Mau Hapus Waktu Film ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                                <form action="{{ route('time.delete', $item->id) }}" method="GET">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger"><ion-icon name="trash-outline"></ion-icon> Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Delete Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    @endpush

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
