<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- Components --}}
    @include('Componen.css')
    @include('Componen.script')
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li>
                            <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
                                <i class="fas fa-bars"></i>
                            </a>
                        </li>
                    </ul>
                    <form action="{{ route('home') }}" method="GET" class="d-flex">
                        <input class="form-control me-2" type="search" name="search" placeholder="Cari judul film"
                            aria-label="Search" required>
                        <button class="btn btn-outline-success" type="submit">Cari</button>
                    </form>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown dropdown-list-toggle">
                        <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep">
                            <i class="far fa-envelope"></i>
                        </a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Messages
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-message">
                                <!-- Message items here -->
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown dropdown-list-toggle">
                        <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep">
                            <i class="far fa-bell"></i>
                        </a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Notifications
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                <!-- Notification items here -->
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
                        </a>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-title">Logged in 5 min ago</div>
                                <a href="features-profile.html" class="dropdown-item has-icon">
                                    <i class="far fa-user"></i> Profile
                                </a>
                                <a href="features-activities.html" class="dropdown-item has-icon">
                                    <i class="fas fa-bolt"></i> Activities
                                </a>
                                <a href="features-settings.html" class="dropdown-item has-icon">
                                    <i class="fas fa-cog"></i> Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        @endguest
                    </li>
                </ul>
            </nav>

            {{-- Sidebar --}}
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">Stisla</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">St</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown">
                                <i class="fas fa-fire"></i>
                                <span>Dashboard</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('home') }}">General Dashboard</a></li>
                                <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
                            </ul>
                        </li>
                        <li class="menu-header">Starter</li>
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown">
                                <i class="far fa-file-alt"></i>
                                <span>Optional</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('genre') }}">Genres</a></li>
                                <li><a class="nav-link" href="{{ route('time') }}">Time</a></li>
                                <li><a class="nav-link" href="{{ route('detail') }}">Add Film</a></li>
                                <li><a class="nav-link" href="{{ route('kursi') }}">Add Chairs</a></li>
                                <li><a class="nav-link" href="{{ route('berita') }}">Add News</a></li>
                            </ul>
                        </li>
                    </ul>
                </aside>
            </div>

            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
