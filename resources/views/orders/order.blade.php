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

        .card-category {
            font-size: 1.1rem;
            font-weight: bold;
        }

        .toast-container {
            position: fixed;
            top: 5px;
            right: 0;
            padding: 20px;
            z-index: 11;
        }

        .toast-body {
            font-size: 1rem;
        }

        .card-title,
        .card-text {
            margin-bottom: 10px;
        }

        .btn-danger,
        .btn-success {
            margin-top: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .btn-danger:hover,
        .btn-success:hover {
            transform: scale(1.05);
        }

        .separator {
            margin: 40px 0;
        }

        .total-payment-label {
            position: relative;
            display: flex;
            font-weight: bold;
        }

        .total-payment-amount {
            font-size: 1.2rem;
            color: #000;
        }

        .no-order-message {
            margin-top: 50px;
            font-size: 1.5rem;
        }

        .card-category {
            margin-bottom: 10px;
            color: #555;
        }

        .badge-genre {
            font-size: 0.9rem;
            margin-right: 0px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
        }

        .toast-container {
            position: fixed;
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

        .warna {
            position: relative;
            left: 7px;
            top: 20px;
        }

        .modal-title {

            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #fff;
            padding: 15px;
            /* text-align:leftd; */
            margin-bottom: 10px;
        }
    </style>
    {{-- data yang ambil dari ordercontroller --}}

    @php
        function getBadgeClass($status)
        {
            switch ($status) {
                case 'paid':
                    return 'badge rounded-pill text-bg-success';
                case 'cancel':
                    return 'badge rounded-pill text-bg-danger';
                default:
                    return 'badge rounded-pill text-bg-secondary';
            }
        }
    @endphp
    @if (session('canceli'))
        <div class="toast-container mt-5 position-fixed top-0 end-0 p-2" style="z-index: 11">
            <div class="toast align-items-center text-bg-success border-0 show slide-down" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('canceli') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (session('cancel'))
        <div class="toast-container mt-5 position-fixed top-0 end-0 p-3" style="z-index: 11">
            <div class="toast align-items-center text-bg-success border-0 show slide-down" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('cancel') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (session('success'))
        <div class="toast-container mt-5 position-fixed top-0 end-0 p-3" style="z-index: 11">
            <div class="toast align-items-center text-bg-success border-0 show slide-down" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container mt-4">

        <div class="form-container">
            @forelse ($order as $item)
                <div class="row mb-4">
                    <div class="col-4">
                        <div class="card">
                            <img src="{{ asset('image/' . $item->detail->foto) }}" class="card-img-top"
                                alt="{{ $item->detail->judul }}">
                            <div class="warna">
                                <span style="margin-left: 10px"
                                    class="{{ getBadgeClass($item->status) }} mb-3">{{ ucfirst($item->status) }}</span>
                            </div>
                            <div class="card-body">


                                <div class="card-category text-dark">Genres:</div>
                                <ul class="list-inline">
                                    @foreach ($item->detail->genres as $genre)
                                        <li class="list-inline-item"><span style="font-size: 50%"
                                                class="badge text-bg-info badge-genre">{{ $genre->genre }}</span></li>
                                    @endforeach
                                </ul>
                                <h4 class="card-category text-dark">Harga:</h4>
                                <h6 class="text-muted">Rp. {{ number_format($item->detail->harga) }}</h6>
                                <h4 class="card-category text-dark ">Deskripsi:</h4>
                                <p class="card-text">{{ $item->detail->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="modal-title">
                                            <div class="d-flex">
                                                <h4 class="category badge border border-secondary text-dark ">Judul:</h4>
                                            </div>
                                            <h5 class="badge text-bg-secondary badge-genre text-light">
                                                {{ $item->detail->judul }}</h5>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="modal-title">
                                            <div class="d-flex">
                                                <h6 class="badge border border-secondary text-dark"><strong>Studio</strong>
                                                </h6>
                                            </div>
                                            <h6 style="margin-right: 4px"
                                                class=" badge text-bg-secondary badge-genre   text-light">
                                                {{ $item->detail->studio->studio }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                {{-- kursi data  --}}
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="modal-title">
                                            <div class="d-flex">
                                                <h6 class="badge border border-secondary text-dark"><strong>Tayang Pada
                                                        :</strong></h6>
                                            </div>
                                            <p style="margin-right: 5px"
                                                class="badge text-bg-warning badge-genre text-light">
                                                {{ strftime('%d, %B, %Y', strtotime($item->tanggal_mulai)) }}</p>
                                            <p style="margin-right: 5px"
                                                class="badge text-bg-warning badge-genre text-light">
                                                {{ $item->detail->time->jam_mulai }}
                                                -{{ $item->detail->time->jam_selesai }}</p>

                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div class="modal-title">
                                            <div class="d-flex">
                                                <label style="margin-bottom: 8px"
                                                    class="badge border border-secondary text-dark">Total Pembayaran
                                                    :</label>
                                            </div>
                                            <h6 class="badge text-bg-secondary badge-genre text-light">Rp.
                                                {{ number_format($item->total_harga) }}</h6>
                                        </div>

                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="modal-title">
                                            <div class="d-flex">
                                                <label style="margin-bottom: 8px"
                                                    class=" badge border border-secondary text-dark">Total Tiket :</label>
                                            </div>
                                            <h6 class="badge text-bg-secondary badge-genre text-light">
                                                {{ $item->jumlah_tiket }}
                                            </h6>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        {{--  @if ($item->status !== 'cancel')  --}}
                                        <ul class="list-unstyled mb-0 modal-title">
                                            <div class="d-flex">
                                                <h6 class="badge border border-secondary text-dark">
                                                    <strong>Kursi</strong>
                                                </h6>
                                            </div>
                                            @foreach ($item->kursi as $kursi)
                                                <h6 class=" badge text-bg-secondary badge-genre text-light">
                                                    {{ $kursi->kursi }}
                                                </h6>
                                            @endforeach
                                        </ul>
                                        {{--  @endif  --}}

                                    </div>
                                </div>

                                @if ($item->status !== 'paid' && $item->status !== 'cancel')
                                    <div class="button-container">
                                        <form action="{{ route('paid', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-success">Bayar</button>
                                        </form>
                                        <form action="{{ route('cancel', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-danger">Cancel</button>
                                        </form>

                                    </div>
                                @endif

                                {{--  @if ($item->status == 'paid')

                                <form action="{{ route('order.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <ion-icon name="trash-outline"></ion-icon> Hapus
                                    </button>
                                </form>


                                @endif  --}}
                                {{--  @if ($item->status == 'paid')
                                    <form action="{{ route('order.delete', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <ion-icon name="trash-outline"></ion-icon> Hapus Riwayat
                                        </button>
                                    </form>
                            </div>
            @endif  --}}

                            </div>
                        </div>
                    </div>

                </div>
                <hr class="separator">
            @empty
            @endforelse
        </div>
    </div>



    <div class="container mt-4">
        <div class="card">
            <h1 style="text-center" class="text-center text-secondary no-order-message">Histori Cancel</h1>
        </div>

        <div class="form-container">
            @forelse ($orders as $item)
                <div class="row mb-4">
                    <div class="col-4">
                        <div class="card">
                            <img src="{{ asset('image/' . $item->detail->foto) }}" class="card-img-top"
                                alt="{{ $item->detail->judul }}">
                            <div class="warna">
                                <span style="margin-left: 10px"
                                    class="{{ getBadgeClass($item->status) }} mb-3">{{ ucfirst($item->status) }}</span>
                            </div>
                            <div class="card-body">


                                <div class="card-category text-dark">Genres:</div>
                                <ul class="list-inline">
                                    @foreach ($item->detail->genres as $genre)
                                        <li class="list-inline-item"><span style="font-size: 50%"
                                                class="badge text-bg-info badge-genre">{{ $genre->genre }}</span></li>
                                    @endforeach
                                </ul>
                                <h4 class="card-category text-dark">Harga:</h4>
                                <h6 class="text-muted">Rp. {{ number_format($item->detail->harga) }}</h6>
                                <h4 class="card-category text-dark ">Deskripsi:</h4>
                                <p class="card-text">{{ $item->detail->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="modal-title">
                                            <div class="d-flex">
                                                <h4 class="category badge border border-secondary text-dark ">Judul:</h4>
                                            </div>
                                            <h5 class="badge text-bg-secondary badge-genre text-light">
                                                {{ $item->detail->judul }}</h5>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="modal-title">
                                            <div class="d-flex">
                                                <h6 class="badge border border-secondary text-dark"><strong>Studio</strong>
                                                </h6>
                                            </div>
                                            <h6 style="margin-right: 4px"
                                                class=" badge text-bg-secondary badge-genre   text-light">
                                                {{ $item->detail->studio->studio }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                {{-- kursi data  --}}
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="modal-title">
                                            <div class="d-flex">
                                                <h6 class="badge border border-secondary text-dark"><strong>Tayang Pada
                                                        :</strong></h6>
                                            </div>
                                            <p style="margin-right: 5px"
                                                class="badge text-bg-warning badge-genre text-light">
                                                {{ strftime('%d, %B, %Y', strtotime($item->tanggal_mulai)) }}</p>
                                            <p style="margin-right: 5px"
                                                class="badge text-bg-warning badge-genre text-light">
                                                {{ $item->detail->time->jam_mulai }}
                                                -{{ $item->detail->time->jam_selesai }}</p>

                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div class="modal-title">
                                            <div class="d-flex">
                                                <label style="margin-bottom: 8px"
                                                    class="badge border border-secondary text-dark">Total Pembayaran
                                                    :</label>
                                            </div>
                                            <h6 class="badge text-bg-secondary badge-genre text-light">Rp.
                                                {{ number_format($item->total_harga) }}</h6>
                                        </div>

                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="modal-title">
                                            <div class="d-flex">
                                                <label style="margin-bottom: 8px"
                                                    class=" badge border border-secondary text-dark">Total Tiket :</label>
                                            </div>
                                            <h6 class="badge text-bg-secondary badge-genre text-light">
                                                {{ $item->jumlah_tiket }}
                                            </h6>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <ul class="list-unstyled mb-0 modal-title">
                                            <div class="d-flex">
                                                <h6 class="badge border border-secondary text-dark">
                                                    <strong>Kursi</strong>
                                                </h6>
                                            </div>
                                            @foreach ($item->kursi as $kursi)
                                                <h6 class=" badge text-bg-secondary badge-genre text-light">
                                                    {{ $kursi->kursi }}
                                                </h6>
                                            @endforeach
                                        </ul>


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <hr class="separator">
            @empty
                <h1 class="text-center text-secondary no-order-message">Tidak Ada Histori</h1>
            @endforelse
        </div>
    </div>

@endsection
