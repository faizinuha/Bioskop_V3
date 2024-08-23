<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NihonFlix') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="icon" href="{{ asset('Logo/Dreamland Theater.jpg') }}">
    <!-- link datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Sebelum penutup </body> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    {{-- css --}}

    <!-- Custom CSS untuk Sidebar dan Overlay -->
    <style>

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100%;
            background-color: #fff !important;
            color: #000;
            padding: 15px;
            transition: transform 0.3s ease-in-out;
            transform: translateX(-100%);
            z-index: 1000;
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s;
            z-index: 999;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            color: #000;
            text-decoration: none;
        }

        .btn-close {
            color: #000;
            font-size: 1.5rem;
            margin: 10px 0;
        }

  .dropdown-item:hover {
        text-decoration: underline;
        color: #0056b3;
    }
    .dropdown-item {
        transition: color 0.3s, text-decoration 0.3s;
    }

    .navbar-brand {
        margin-right: 20px;
    }

    .nav-link {
        display: flex;
        align-items: center;
    }

    .nav-link ion-icon {
        margin-right: 5px;
    }

    .size {
        font-size: 30px;
        /* Adjust the font size as needed */
        width: 30px;
        /* Adjust the width as needed */
        height: 30px;
        /* Adjust the height as needed */
    }

    .size-icon {
        margin-top: 10px;
        font-size: 30px;
        /* Adjust the font size as needed */
        width: 30px;
        /* Adjust the width as needed */
        height: 30px;
        /* Adjust the height as needed */
        ;
    }

    /* Media Queries for Responsive Design */
    @media (max-width: 768px) {
        .navbar-nav {
            text-align: center;
        }

        .navbar-collapse {
            margin-top: 10px;
        }
    }

    @media (max-width: 576px) {
        .size {
            font-size: 24px;
            /* Adjust the font size for small screens */
            width: 24px;
            /* Adjust the width for small screens */
            height: 24px;
            /* Adjust the height for small screens */
        }

        .film-card {
            flex: 0 0 calc(50% - 20px);
        }

        .film-container {
            padding: 5px;
        }
    }
    .offcanvas {
        background-color: #f8f9fa;
        /* Light background color */
    }

    .offcanvas-header {
        text-align: center;
        background-color: #0056b3;
        /* Dark background color */
        color: #ffffff;
        /* White text color */
    }
    .text{
        text-align: center;
        justify-content: center;

    }
    .offcanvas-body {
        padding: 20px;
    }

    .offcanvas-body ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .offcanvas-body li {
        margin-bottom: 10px;
    }

    .offcanvas-body a {
        color: #0056b3 ;
        /* Dark text color */
        text-decoration: none;
        font-weight: bold;
    }

    .offcanvas-body a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <button class="nav-link btn" type="button" onclick="toggleSidebar()">
                    <ion-icon name="menu-outline" class="size"></ion-icon>
                </button>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'NihonFlix') }}
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('genre.tampilan') }}">
                                <ion-icon name="albums-outline"></ion-icon>{{ __('Genres') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('film') }}">
                                <ion-icon name="film-outline"></ion-icon>{{ __('Film') }}
                            </a>
                        </li>
                    </ul>
                    <!-- Center Search Form -->
                    @yield('search')
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        {{--  <a href="{{ route('histori') }}">
                            <ion-icon name="cart" class="size-icon"></ion-icon>
                        </a>  --}}
                        <a href="{{ route('order.index') }}">
                            <ion-icon name="cart" class="size-icon"></ion-icon>
                        </a>
                        <!-- Color Change Dropdown -->
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarColorDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <ion-icon name="color-palette-outline" class="size"></ion-icon>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end posmen navbar-tog"
                                aria-labelledby="navbarColorDropdown">
                                <li>
                                    <button class="dropdown-item" onclick="changeNavbarColor('navbar-light')">
                                        <ion-icon name="caret-forward"></ion-icon>Light
                                    </button>
                                </li>
                                <li>
                                    <button class="dropdown-item" onclick="changeNavbarColor('navbar-dark')">
                                        <ion-icon name="caret-forward"></ion-icon>Dark
                                    </button>
                                </li>
                                <li>
                                    <button class="dropdown-item" onclick="changeNavbarColor('navbar-secondary')">
                                        <ion-icon name="caret-forward"></ion-icon>Secondary
                                    </button>
                                </li>
                                <li>
                                    <button class="dropdown-item" onclick="changeNavbarColor('navbar-success')">
                                        <ion-icon name="caret-forward"></ion-icon>Success
                                    </button>
                                </li>
                                <li>
                                    <button class="dropdown-item" onclick="changeNavbarColor('navbar-danger')">
                                        <ion-icon name="caret-forward"></ion-icon>Danger
                                    </button>
                                </li>
                                <li>
                                    <button class="dropdown-item" onclick="changeNavbarColor('navbar-primary-rgba')">
                                        <ion-icon name="caret-forward"></ion-icon>Rgba
                                    </button>
                                </li>
                            </ul>
                        </li> --}}
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <ion-icon name="log-in-outline"></ion-icon>{{ __('Login') }}
                                    </a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <ion-icon name="person-add-outline"></ion-icon>{{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <ion-icon name="person-outline"></ion-icon>{{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-center" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                                                      {{ __('Logout') }}
                                        {{-- <ion-icon name="log-out-outline"></ion-icon>--}}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Sidebar Content -->
    <div class="sidebar">
        <button class="btn-close" onclick="toggleSidebar()">Option&times;</button>
        <ul>
            <li>
                <a class="dropdown-item" href="{{ route('genre') }}">
                    <ion-icon name="albums-outline"></ion-icon> Tambah Genre
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('time') }}">
                    <ion-icon name="time-outline"></ion-icon> Tambah Waktu
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('tanggal.index') }}">
                    <ion-icon name="calendar-outline"></ion-icon> Tambah Tanggal
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('detail') }}">
                    <ion-icon name="film-outline"></ion-icon> Tambah Film
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('studio') }}">
                    <ion-icon name="videocam-outline"></ion-icon> Tambah Studio
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('kursi.index') }}">
                    <ion-icon name="ticket-outline"></ion-icon> Tambah Kursi
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('berita') }}">
                    <ion-icon name="newspaper-outline"></ion-icon> Tambah Berita
                </a>
            </li>
        </ul>
    </div>
    <!-- Overlay -->
    <div class="overlay" onclick="toggleSidebar()"></div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Isotope -->
    <link rel="stylesheet" href="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.css">
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

    <!-- DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Bootstrap JavaScript and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- AOS JavaScript -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- Custom JS untuk Toggle Sidebar -->
    <script>

        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.overlay').classList.toggle('active');
        }
    </script>
    <!-- Ionicons -->
    <script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
