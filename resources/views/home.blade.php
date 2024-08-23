@extends('layouts.app')

@section('search')
    <form action="{{ route('home') }}" method="GET" class="d-flex">
        <input class="form-control me-2" type="search" name="search" placeholder="Cari judul film" aria-label="Search"
            required>
        <a class="btn btn-outline-primary" href="{{ route('home') }}">Refresh</a>
    </form>
@endsection
{{-- @if ('berhasil')
    <div class="toast-con mt-5 position-fixed" style="top: 100px; right: 0; z-index: 20">
        <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('berhasil') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'));
            var toastList = toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl, {
                    delay: 3000
                });
            });
            toastList.forEach(toast => toast.show());
        });
    </script>
@endif --}}

{{-- order --}}
@if (session('success'))
    <div class="toast-container mt-5 position-fixed top-0 end-0 p-3" style="z-index: 11">
        <div class="toast mt-3 align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'));
            var toastList = toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl, {
                    delay: 3000
                });
            });
            toastList.forEach(toast => toast.show());
        });
    </script>
@endif


@section('content')
    <style>
        .toast-con {
            max-width: 300px;
        }

        * {
            transition: all 0.3s ease;
            scroll-behavior: smooth;
            scroll-padding: 10px;
        }



        .film-card {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            margin: 10px;
            flex: 0 0 calc(16.66% - 20px);
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
            width: 150%;
            height: 400px;
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

        .carousel-caption-custom {
            position: relative;
            top: -45px;
            bottom: 25px;
            left: 50%;
            transform: translateX(-50%);
            /* padding: 10px;
                border-radius: 10px; */
            text-align: center;
            width: 90%;
        }

        .carousel-caption-custom h5,
        .carousel-caption-custom p {
            margin: 0;
            color: black;
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

        .warna {}
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card text-center mb-4 back">
                    <div class="card-header">{{ __('Bioskop') }}</div>
                    <div class="card-body">
                        <p>{{ __('Selamat Datang di Bioskop') }}</p>
                    </div>
                </div>

                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($detail as $key => $item)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset('image/' . $item->foto) }}" class="d-block w-100"
                                    alt="{{ $item->judul }}" data-aos="fade-up">
                                {{--  <div class="carousel-caption-custom d-none d-md-block">
                                    <h5><strong>{{ $item->judul }}</strong></h5>
                                    <p><strong>{{ $item->deskripsi }}</strong></p>
                                </div>  --}}
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>


                <div id="filmCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="film-container">
                                @forelse ($detail as $item)
                                    <div class="film-card" data-aos="fade-right" data-bs-toggle="modal"
                                        data-bs-target="#filmModal{{ $item->id }}">
                                        <img src="{{ asset('image/' . $item->foto) }}" class="img-fluid"
                                            alt="{{ $item->judul }}">
                                        <div class="film-description">
                                            <button class="btn-pesan"
                                                onclick="link('{{ route('order.create', $item->id) }}')">
                                                <ion-icon name="cart-outline"></ion-icon> Pesan
                                            </button>
                                        </div>
                                        <div class="film-label-container">
                                            <label style="margin-bottom: 5px" class="film-label">{{ $item->judul }}</label>
                                            <h6 style="font-size: 13px " class="badge border border-success text-success"><strong>Studio:</strong></h6>
                                            <p class="badge text-bg-secondary badge-genre text-light" style="font-size: 11px">{{ $item->studio->studio }}</p>
                                            <div class="d-flex">

                                        <h6 style="font-size: 13px" class="badge border border-secondary text-secondary"><strong>Tayang Pada:</strong></h6>

                                            </div>
                                            <div style="margin-bottom: 0%" class="d-flex">
                                                <p style="font-size: 8                          px; margin-right: 5px" class="badge text-bg-warning badge-genre text-light ">{{ strftime('%d, %B, %Y', strtotime($item->tanggal_mulai)) }} - {{ strftime('%d, %B, %Y', strtotime($item->tanggal_selesai)) }}</p>
                                            </div>
                                            <p style="font-size: 8px" class="badge text-bg-warning badge-genre text-light "> {{ $item->time->jam_mulai }} - {{ $item->time->jam_selesai }}</p>

                                        </div>
                                    </div>
                                    
                                @empty
                                    <div class="empty-message-container">
                                        <p class="empty-message">Tidak Ada Film</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="news-container">
                    <h2>Berita</h2>
                    <div class="row">
                        <!-- Berita 1 -->
                        @foreach ($berita as $item)
                            <div class="news-card col-md-4">
                                <img src="{{ asset('imageBerita/' . $item->foto_deskripsi) }}" class="img-fluid"
                                    alt="{{ $item->judul }}">
                                <div class="news-body">
                                    <h5 class="news-title">{{ $item->judul }}</h5>
                                    <p class="news-text">{{ $item->deskripsi }}</p>
                                        <h6 style="font-size: 13px" class="badge border border-secondary text-secondary"><strong>Di Unggah Pada:</strong></h6>
                                        <p style="font-size: 11px; margin-right: 5px" class="badge text-bg-warning badge-genre text-light ">{{ $item->tanggal }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Placeholder jika tidak ada berita -->
                    @if ($berita->isEmpty())
                        <p class=" text-secondary text-center">Tidak Ada Berita Hari Ini</p>
                    @endif
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var myCarousel = document.querySelector('#film');
                        var carousel = new bootstrap.Carousel(myCarousel, {
                            interval: 2000,
                            wrap: true
                        });

                        // Variabel untuk menyimpan posisi awal dan akhir dari swipe/drag
                        var touchStartX = 0;
                        var touchEndX = 0;

                        // Menangani swipe pada perangkat seluler
                        myCarousel.addEventListener('touchstart', function(event) {
                            touchStartX = event.changedTouches[0].screenX;
                        });

                        myCarousel.addEventListener('touchend', function(event) {
                            touchEndX = event.changedTouches[0].screenX;
                            handleSwipe();
                        });

                        // Menangani drag pada perangkat desktop
                        myCarousel.addEventListener('mousedown', function(event) {
                            touchStartX = event.screenX;
                        });

                        myCarousel.addEventListener('mouseup', function(event) {
                            touchEndX = event.screenX;
                            handleSwipe();
                        });

                        // Fungsi untuk menentukan arah swipe atau drag
                        function handleSwipe() {
                            if (touchEndX < touchStartX) {
                                // Geser ke kiri (slide berikutnya)
                                carousel.next();
                            }
                            if (touchEndX > touchStartX) {
                                // Geser ke kanan (slide sebelumnya)
                                carousel.prev();
                            }
                        }
                    });

                    function link(url) {
                        window.location.href = url;
                    }
                </script>
            </div>
        </div>
    </div>
@endsection
