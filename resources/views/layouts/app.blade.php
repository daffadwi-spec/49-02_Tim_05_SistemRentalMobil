<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Informasi Rental Mobil')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            color: #212529;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        /* Gaya Kotak-Kotak Tegas */
        .card, .btn, .form-control, .form-select, .alert, .dropdown-menu, .badge {
            border-radius: 4px !important;
        }
        .card {
            border: 1px solid #cfd4da;
            box-shadow: none;
            background-color: #ffffff;
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #cfd4da;
            font-weight: 600;
            padding: 0.85rem 1.2rem;
        }
        .card-body {
            padding: 1.2rem;
        }
        .box-link {
            display: block;
            text-decoration: none;
            color: inherit;
            border: 1px solid #cfd4da;
            background-color: #ffffff;
            border-radius: 4px;
            transition: border-color 0.15s ease, background-color 0.15s ease;
        }
        .box-link:hover {
            border-color: #0d6efd;
            background-color: #f8fbff;
        }
        .table {
            margin-bottom: 0;
        }
        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 1px solid #cfd4da;
            font-size: 0.85rem;
            font-weight: 600;
            color: #343a40;
        }
        footer {
            margin-top: auto;
            background-color: #ffffff;
            border-top: 1px solid #cfd4da;
            font-size: 0.85rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">RentalMobil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active fw-semibold' : '' }}" href="{{ url('/') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('armada.*') ? 'active fw-semibold' : '' }}" href="{{ route('armada.index') }}">Data Armada</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('paket.*') ? 'active fw-semibold' : '' }}" href="{{ route('paket.index') }}">Paket Rental</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('drivers.*') ? 'active fw-semibold' : '' }}" href="{{ route('drivers.index') }}">Data Driver</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('jenis-layanan', 'mitra-perawatan', 'lokasi', 'kontak') ? 'active fw-semibold' : '' }}" href="#" role="button" data-bs-toggle="dropdown">
                            Info Layanan
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/jenis-layanan') }}">Jenis Layanan</a></li>
                            <li><a class="dropdown-item" href="{{ url('/mitra-perawatan') }}">Mitra Perawatan</a></li>
                            <li><a class="dropdown-item" href="{{ url('/lokasi') }}">Lokasi</a></li>
                            <li><a class="dropdown-item" href="{{ url('/kontak') }}">Kontak</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    @auth
                        <span class="text-light small me-1">
                            {{ auth()->user()->nama ?? auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})
                        </span>
                        <a href="{{ url('/logout') }}" class="btn btn-outline-light btn-sm">Keluar</a>
                    @else
                        <a href="{{ url('/login?role=pelanggan') }}" class="btn btn-primary btn-sm">Login Pelanggan</a>
                        <a href="{{ url('/login-owner') }}" class="btn btn-outline-light btn-sm">Login Owner</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="container pb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="py-3 text-center">
        <div class="container">
            Sistem Informasi Rental Mobil &copy; {{ date('Y') }}
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>