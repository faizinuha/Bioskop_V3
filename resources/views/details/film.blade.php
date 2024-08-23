@extends('layouts.app')

@section('content')

@section('search')
    <form action="{{ route('detail') }}" method="GET" class="d-flex">
        <input class="form-control me-2" type="search" name="search" placeholder="Cari judul film" aria-label="Search" required>
        <a class="btn btn-outline-primary" href="{{ route('film') }}">Refresh</a>
    </form>
@endsection

<style>
    * {
        scroll-behavior: smooth;
    }

    .film-card {
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        margin: 10px;
        flex: 0 0 calc(22.66% - 20px);
        box-sizing: border-box;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        background-color: #fff;
    }

    .film-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .film-card img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        transition: transform 0.3s ease;
        border-radius: 10px 10px 0 0;
    }

    .film-card:hover img {
        transform: scale(1.05);
    }

    .film-description {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.7) 100%);
        color: #fff;
        padding: 20px;
        opacity: 0;
        transition: opacity 0.3s ease;
        text-align: center;
        border-radius: 0 0 10px 10px;
    }

    .film-card:hover .film-description {
        opacity: 1;
    }

    .film-label-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 10px;
    }

    .film-label {
        margin: 0;
        font-size: 1.1rem;
        font-weight: bold;
    }

    .btn-pesan {
        background-color: #ff6b6b;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 20px;
        cursor: pointer;
        font-size: 0.9rem;
        transition: background-color 0.3s ease, transform 0.3s ease;
        opacity: 0.9;
        margin-top: 10px;
    }

    .btn-pesan:hover {
        background-color: #ff4757;
        transform: scale(1.05);
    }

    .film-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        padding: 10px;
    }

    .film-container::-webkit-scrollbar {
        display: none;
    }

    .carousel-control-prev,
    .carousel-control-next {
        display: none;
    }

    .back {
        color: #ffffff;
        background-color: #000;
        object-fit: cover;
        background-clip: border-box;
        background: url({{ asset('Logo/1721275807_netflix.jpg') }});
        border-radius: 10px;
    }

    .carousel-inner img {
        border-radius: 20px;
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .carousel-item {
        transition: transform 0.3s ease, opacity 0.3s ease;
    }

    @media (max-width: 1200px) {
        .film-card {
            flex: 0 0 calc(20% - 20px);
        }
    }

    @media (max-width: 992px) {
        .film-card {
            flex: 0 0 calc(25% - 20px);
        }
    }

    @media (max-width: 768px) {
        .film-card {
            flex: 0 0 calc(33.33% - 20px);
        }
    }

    @media (max-width: 576px) {
        .film-card {
            flex: 0 0 calc(50% - 20px);
        }

        .carousel-inner img {
            height: 150px;
        }
    }

    @media (max-width: 400px) {
        .film-card {
            flex: 0 0 calc(100% - 20px);
        }

        .carousel-inner img {
            height: 120px;
        }
    }

    .news-container {
        margin-top: 20px;
    }

    .news-card {
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        margin: 10px;
        flex: 0 0 calc(33.33% - 20px);
        box-sizing: border-box;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        background-color: #fff;
    }

    .news-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .news-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
        border-radius: 10px 10px 0 0;
    }

    .news-card:hover img {
        transform: scale(1.05);
    }

    .news-body {
        padding: 15px;
    }

    .news-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .news-text {
        font-size: 1rem;
        color: #333;
        margin-bottom: 10px;
    }

    .news-time {
        font-size: 0.85rem;
        color: #888;
    }

    @media (max-width: 768px) {
        .news-card {
            flex: 0 0 calc(50% - 20px);
        }
    }

    @media (max-width: 576px) {
        .news-card {
            flex: 0 0 calc(100% - 20px);
        }
    }

    /* Penambahan CSS untuk modal card */
    .modal-card {
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      background-color: #fff;
      padding: 15px;
      margin-bottom: 10px;
  }

    .modal-card img {
        width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .modal-card h6 {
        font-size: 1rem;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .modal-card p {
        font-size: 0.9rem;
        color: #333;
    }

    .badge-genre {
        font-size: 0.85rem;
        padding: 5px 10px;
        border-radius: 5px;
        margin-right: 5px;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="text-center text-secondary">Daftar Film</h1>
            <div class="container mt-4" id="film">
                <div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="film-container">
                                @forelse ($detail as $item)
                                    <div class="film-card" data-bs-toggle="modal" data-bs-target="#filmModal{{ $item->id }}">
                                        <img src="{{ asset('image/' . $item->foto) }}" class="img-fluid" alt="{{ $item->judul }}">
                                        <div class="film-label-container">
                                            <label class="film-label">{{ $item->judul }}</label>
                                            <div class="d-flex">
                                                <h6 style="font-size: 13px; margin-bottom: 5px" class="badge border border-secondary text-secondary">
                                                    <strong>Tayang Pada:</strong>
                                                </h6>
                                            </div>
                                            <div class="d-flex">
                                                <p style="font-size: 7px; margin-right: 9px" class="badge text-bg-warning badge-genre text-light">
                                                    {{ strftime('%d, %B, %Y', strtotime($item->tanggal->tanggal_mulai)) }}</p>
                                            </div>
                                            <p style="font-size: 8px; margin-top:0%" class="badge text-bg-warning badge-genre text-light">
                                                {{ $item->time->jam_mulai }} - {{ $item->time->jam_selesai }}</p>
                                        </div>

                                    </div>
                                @empty
                                    <h1 class="text-center text-secondary">Tidak Ada Film Yang di Upload</h1>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($detail as $item)
                    <div class="modal fade" id="filmModal{{ $item->id }}" tabindex="-1" aria-labelledby="filmModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="filmModalLabel{{ $item->id }}">{{ $item->judul }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="modal-card">
                                                <img src="{{ asset('image/' . $item->foto) }}" class="img-fluid" alt="{{ $item->judul }}">
                                                <div class="modal-card">
                                                    <h6>Genre:</h6>
                                                    <ul class="list-unstyled">
                                                        @foreach ($item->genres as $genre)
                                                            <li class="list-inline-item">
                                                                <span style="font-size:50%; margin-left:0%" class="badge text-bg-info badge-genre">{{ $genre->genre }}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="modal-card">
                                                    <h6>Tanggal Rilis:</h6>
                                                    <p class="badge text-bg-secondary badge-genre text-light">{{ $item->tanggalRilis }}</p>
                                                </div>


                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="modal-card">
                                                <h6>Studio:</h6>
                                                <p class="badge text-bg-secondary badge-genre text-light">{{ $item->studio->studio }}</p>
                                            </div>
                                            <div class="modal-card">
                                                <h6>Tayang Pada:</h6>
                                                <p class="badge text-bg-warning badge-genre text-light">{{ strftime('%d, %B, %Y', strtotime($item->tanggal->tanggal_mulai)) }} - {{  strftime('%d, %B, %Y', strtotime($item->tanggal->tanggal_selesai))}}</p>
                                                <p style="font-size: 11px" class="badge text-bg-warning badge-genre text-light "> {{ $item->time->jam_mulai }} - {{ $item->time->jam_selesai }}</p>
                                            </div>
                                            <div class="modal-card">
                                                <h6>Perusahaan Produksi:</h6>
                                                <p class="badge text-bg-secondary badge-genre text-light">{{ $item->perusahaanProduksi }}</p>
                                            </div>
                                            <div class="modal-card">
                                                <h6>Deskripsi:</h6>
                                                <p>{{ $item->deskripsi }}</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myCarousel = document.querySelector('#film');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 2000,
            wrap: true
        });
    });

    function link(url) {
        window.location.href = url;
    }
</script>

@endsection
