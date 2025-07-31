<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SIKUM')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ======= GLOBAL STYLES ======= */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafb;
            padding-top: 80px;
            color: #005800
        }
        
        .card {
            border: none;
            box-shadow: 0 0.5rem 2rem rgba(0, 0, 0, 0.08);
            border-radius: 1rem;
            transition: all 0.3s ease;
            background: #ffffff;
            backdrop-filter: blur(10px);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.12);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #27ae60 0%, #219150 100%);
            border: none;
            transition: all 0.3s ease;
            padding: 0.625rem 1.25rem;
        }
        
        .btn-primary:hover {
            background-color: #219150;
            border-color: #219150;
            transform: scale(1.02);
        }
        
        /* ======= NAVBAR STYLES ======= */
        .navbar {
            box-shadow: 0 0.125rem 0.25rem rgba(39, 174, 96, 0.075);
            height: 80px;
        }
        
        .navbar-custom {
            background: linear-gradient(135deg, #219150 0%, #27ae60 100%) !important;
            padding: 1rem 0;
            box-shadow: 0 4px 20px rgba(39,174,96,0.15);
            backdrop-filter: blur(10px);
        }
        
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #ffffff !important;
            position: relative;
            font-weight: 500;
        }
        
        .navbar-custom .nav-link:hover {
            color: #e0ffe0 !important;
            background-color: rgba(255, 255, 255, 0.15) !important;
            transform: translateY(-1px);
        }
        
        .btn-register, .btn-outline-light {
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            letter-spacing: 0.5px;
            height: 38px;
        }
        
        .btn-register {
            background-color: rgba(255, 255, 255, 0.9);
            color: #219150;
            border: none;
        }
        
        .btn-register:hover {
            background-color: #ffffff;
            color: #27ae60;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }
        
        .btn-outline-light {
            border: 2px solid rgba(255, 255, 255, 0.8);
            color: #ffffff;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: #ffffff;
            transform: translateY(-2px);
            color: #ffffff;
        }
        
        .dropdown-menu {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
            padding: 0.5rem;
            margin-top: 0.5rem;
        }
        
        .dropdown-item {
            padding: 0.625rem 1rem;
            font-size: 0.9rem;
            transition: all 0.2s;
            border-radius: 0.5rem;
            margin: 0.125rem 0;
        }
        
        .dropdown-item:hover {
            background-color: rgba(39, 174, 96, 0.1);
            color: #219150;
        }
        
        .dropdown-menu .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
            transition: all 0.2s;
            padding: 0.5rem;
            margin: 0.5rem 0;
        }
        
        .dropdown-menu .btn-danger:hover {
            background-color: #bb2d3b;
            border-color: #b02a37;
            transform: translateY(-1px);
        }
        
        .navbar-custom .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }
        
        .navbar-custom .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.85%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        
        .hover-brighten:hover {
            opacity: 0.85;
            transform: translateY(-1px);
            transition: all 0.3s ease;
        }
        
        .btn-outline-light.active {
            background-color: #ffffff !important;
            color: #219150 !important;
            border-color: #ffffff !important;
        }
        
        .navbar .vr {
            height: 24px;
        }
        
        .navbar-collapse {
            background-color: #145a32;
            border-radius: 0.5rem;
            margin-top: 1rem;
            padding: 1rem;
            box-shadow: 0 4px 8px rgba(39, 174, 96, 0.1);
        }
        
        .btn-danger.btn-sm {
            font-size: 0.875rem;
            padding: 0.25rem 0.75rem;
            transition: all 0.3s ease;
        }
        
        .btn-danger.btn-sm:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
        }
        
        .navbar-nav .nav-link {
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
        }
        
        .navbar-nav .nav-link.active {
            background-color: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
        }
        
        .navbar-logo {
            width: 35px;
            height: auto;
        }
        
        .navbar-brand-text {
            line-height: 1;
        }
        
        .navbar-app-name {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        
        .navbar-jargon {
            font-size: 0.7rem;
            font-weight: 400;
            color: #b9f6ca !important;
            opacity: 0.9;
        }
        
        /* ======= MULTI-LEVEL DROPDOWN STYLES ======= */
        .dropdown-submenu {
            position: relative;
        }
        
        .dropdown-submenu .dropdown-submenu-content {
            display: none;
            position: absolute;
            left: 100%;
            top: 0;
            margin-top: -0.5rem;
            margin-left: 0.1rem;
            border-radius: 0.75rem;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
            min-width: 120px;
            background-color: #fff;
            z-index: 1000;
        }
        
        .dropdown-submenu:hover > .dropdown-submenu-content {
            display: block;
        }
        
        .dropdown-submenu .dropdown-item {
            white-space: nowrap;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .dropdown-submenu .dropdown-submenu-content {
                position: static;
                margin-left: 1rem;
                margin-top: 0.25rem;
                border-left: 2px solid rgba(39, 174, 96, 0.2);
                box-shadow: none;
            }
        }
        
        /* ======= FOOTER STYLES ======= */
        .footer-custom {
            background: linear-gradient(135deg, #219150 0%, #27ae60 100%);
            color: #ffffff;
            padding: 4rem 0 1rem 0;
            margin-top: 6rem;
            position: relative;
            overflow: hidden;
        }
        
        .footer-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.1;
            pointer-events: none;
            z-index: 0;
        }
        
        .footer-content {
            position: relative;
            z-index: 1;
        }
        
        .footer-logo {
            max-width: 70px;
            height: auto;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
            transition: transform 0.3s ease;
        }
        
        .footer-logo:hover {
            transform: scale(1.05);
        }
        
        .footer-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .footer-subtitle {
            font-size: 0.95rem;
            color: #b9f6ca;
            margin-bottom: 1rem;
        }
        
        .footer-description {
            font-size: 0.9rem;
            line-height: 1.6;
            color: #e9ffe9;
            margin-bottom: 1.5rem;
        }
        
        .footer-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #ffffff;
        }
        
        .footer-link {
            color: #b9f6ca;
            text-decoration: none;
            font-size: 0.9rem;
            display: block;
            margin-bottom: 0.5rem;
            transition: color 0.3s ease;
            position: relative;
        }
        
        .footer-link:hover {
            color: #ffffff;
            text-decoration: none;
        }
        
        .footer-social-icons {
            margin-top: 1rem;
        }
        
        .footer-social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: #b9f6ca;
            text-decoration: none;
            margin-right: 0.75rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 1.1rem;
            position: relative;
        }
        
        .footer-social-icon:hover {
            background-color: #ffffff;
            color: #27ae60;
            transform: translateY(-3px) rotate(8deg);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            border-color: transparent;
        }
        
        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
            position: relative;
        }
        
        .footer-contact-item i {
            margin-right: 0.75rem;
            margin-top: 0.2rem;
            color: #b9f6ca;
            min-width: 16px;
            text-align: center;
        }
        
        .footer-contact-item span {
            color: #e9ffe9;
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.5rem;
            margin-top: 2rem;
        }
        
        .footer-bottom-text {
            font-size: 0.85rem;
            color: #b9f6ca;
            margin: 0;
        }
        
        .footer-developer {
            font-size: 0.85rem;
            color: #b9f6ca;
            margin: 0;
        }
        
        .footer-developer a {
            color: #b9f6ca;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-developer a:hover {
            color: #ffffff;
        }
        
        /* ======= ALERT STYLES ======= */
        .alert-success .bi-check-circle-fill,
        .alert-danger .bi-exclamation-triangle-fill {
            font-size: 1.25rem;
            margin-right: 0.5rem;
        }
        
        /* ======= RESPONSIVE ADJUSTMENTS ======= */
        @media (max-width: 991.98px) {
            .navbar-app-name {
                font-size: 1.2rem;
            }
            .navbar-jargon {
                font-size: 0.65rem;
            }
        }
        
        @media (max-width: 767.98px) {
            .navbar {
                height: 70px;
                padding: 0.5rem 1rem;
            }
            body {
                padding-top: 70px;
            }
            .navbar-app-name {
                font-size: 1rem;
            }
            .navbar-jargon {
                font-size: 0.6rem;
            }
            .navbar-nav .nav-link {
                padding: 0.5rem;
                font-size: 0.9rem;
            }
            .btn-register {
                padding: 0.375rem 0.75rem;
                font-size: 0.875rem;
            }
            .alert {
                font-size: 0.875rem;
            }
            .main {
                padding-top: 1rem;
                padding-bottom: 1rem;
            }
            .footer-custom {
                padding: 2rem 0 1rem 0;
            }
            .footer-title {
                font-size: 1.3rem;
            }
            .footer-section-title {
                font-size: 1rem;
                margin-top: 1.5rem;
            }
        }
        
        @media (max-width: 575.98px) {
            .navbar {
                height: 60px;
            }
            body {
                padding-top: 60px;
            }
            .navbar-app-name {
                font-size: 0.9rem;
            }
            .navbar-jargon {
                font-size: 0.55rem;
            }
            .navbar-toggler-icon {
                width: 1.2em;
                height: 1.2em;
            }
            .dropdown-item {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }
            .footer-bottom {
                text-align: center;
            }
            .footer-bottom .row > div {
                margin-bottom: 0.5rem;
            }
        }
    </style>
    @yield('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg fixed-top navbar-custom">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('img/Lambang_Kabupaten_Purworejo.png') }}" alt="Logo Kabupaten Purworejo" class="navbar-logo me-3">
                <div class="navbar-brand-text">
                    <div class="navbar-app-name">SIKUM</div>
                    <div class="navbar-jargon">Mewujudkan Tata Kelola Perkantoran yang Modern, Efisien, dan Terintegrasi</div>
                </div>
            </a>
            <div class="d-flex align-items-center ms-auto">
                <ul class="navbar-nav d-flex flex-row">
                    @auth
                        <div class="d-flex align-items-center gap-1">
                            <div class="dropdown me-2">
                                <a class="btn btn-outline-light rounded-pill dropdown-toggle {{ (request()->routeIs('opd.index') || request()->routeIs('asisten.index')) ? 'active' : '' }}"
                                href="#" role="button" id="dataMasterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-server me-1"></i>Data Master
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dataMasterDropdown">
                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('opd.index') ? 'active' : '' }}" href="{{ route('opd.index') }}">
                                            <i class="bi bi-building me-2"></i>OPD
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('asisten.index') ? 'active' : '' }}" href="{{ route('asisten.index') }}">
                                            <i class="bi bi-person-badge me-2"></i>Asisten
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- SK Dropdown -->
                            <div class="dropdown me-2">
                                <a class="btn btn-outline-light rounded-pill dropdown-toggle {{ (request()->routeIs('sk') || request()->routeIs('sk-proses')) ? 'active' : '' }}" 
                                   href="#" role="button" id="skDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-file-text me-1"></i>SK
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="skDropdown">
                                    <!-- Menu SK dengan submenu tahun -->
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item {{ request()->routeIs('sk') ? 'active' : '' }} d-flex justify-content-between align-items-center" 
                                           href="{{ route('sk') }}">
                                            <span><i class="bi bi-file-earmark me-2"></i>Penomoran SK</span>
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-submenu-content">
                                            @for($year = date('Y'); $year >= 2021; $year--)
                                                <li><a class="dropdown-item" href="{{ route('sk.year', ['year' => $year]) }}">{{ $year }}</a></li>
                                            @endfor
                                        </ul>
                                    </li>
                                    
                                    <!-- Menu Proses SK dengan submenu tahun -->
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item {{ request()->routeIs('sk-proses') ? 'active' : '' }} d-flex justify-content-between align-items-center" 
                                           href="{{ route('sk-proses') }}">
                                            <span><i class="bi bi-gear me-2"></i>Proses SK</span>
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-submenu-content">
                                            @for($year = date('Y'); $year >= 2021; $year--)
                                                <li><a class="dropdown-item" href="{{ route('sk-proses.year', ['year' => $year]) }}">{{ $year }}</a></li>
                                            @endfor
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            
                            <!-- Perbup Dropdown -->
                            <div class="dropdown me-2">
                                <a class="btn btn-outline-light rounded-pill dropdown-toggle {{ (request()->routeIs('perbup') || request()->routeIs('perbup-proses')) ? 'active' : '' }}" 
                                   href="#" role="button" id="perbupDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-journal-text me-1"></i>Perbup
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="perbupDropdown">
                                    <!-- Menu Perbup dengan submenu tahun -->
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item {{ request()->routeIs('perbup') ? 'active' : '' }} d-flex justify-content-between align-items-center" 
                                           href="{{ route('perbup') }}">
                                            <span><i class="bi bi-journal me-2"></i>Penomoran Perbup</span>
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-submenu-content">
                                            @for($year = date('Y'); $year >= 2021; $year--)
                                                <li><a class="dropdown-item" href="{{ route('perbup.year', ['year' => $year]) }}">{{ $year }}</a></li>
                                            @endfor
                                        </ul>
                                    </li>
                                    
                                    <!-- Menu Proses Perbup dengan submenu tahun -->
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item {{ request()->routeIs('perbup-proses') ? 'active' : '' }} d-flex justify-content-between align-items-center" 
                                           href="{{ route('perbup-proses') }}">
                                            <span><i class="bi bi-gear me-2"></i>Proses Perbup</span>
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-submenu-content">
                                            @for($year = date('Y'); $year >= 2021; $year--)
                                                <li><a class="dropdown-item" href="{{ route('perbup-proses.year', ['year' => $year]) }}">{{ $year }}</a></li>
                                            @endfor
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown me-2">
                                <a class="btn btn-outline-light rounded-pill dropdown-toggle {{ request()->routeIs('sk-lainnya.*') ? 'active' : '' }}" 
                                   href="#" role="button" id="skLainnyaDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-file-earmark-text me-1"></i>SK Lainnya
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="skLainnyaDropdown">
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item {{ request()->routeIs('sk-lainnya.index') ? 'active' : '' }} d-flex justify-content-between align-items-center" 
                                           href="{{ route('sk-lainnya.index') }}">
                                            <span><i class="bi bi-calendar-event me-2"></i>Pilih Tahun SK Lainnya</span>
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-submenu-content">
                                            @php $years = range(date('Y'), 2021); @endphp
                                            @foreach($years as $year)
                                                <li><a class="dropdown-item" href="{{ route('sk-lainnya.year', ['year' => $year]) }}">{{ $year }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                            <div class="vr text-light opacity-25 mx-2"></div>
                            
                            <!-- User Profile Dropdown -->
                            <div class="dropdown">
                                <a class="d-flex align-items-center text-light text-decoration-none hover-brighten dropdown-toggle" 
                                   href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle me-2"></i>
                                    <span class="fw-medium">{{ Auth::user()->nama }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="bi bi-person me-2"></i>Profil</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="d-flex align-items-center gap-2">
                            <a class="btn btn-outline-light rounded-pill px-3 d-flex align-items-center" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                <span>Login</span>
                            </a>
                            <a class="btn btn-light btn-register rounded-pill px-3 d-flex align-items-center" href="{{ route('register') }}">
                                <i class="bi bi-person-plus me-2"></i>
                                <span>Daftar</span>
                            </a>
                        </div>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4 flex-grow-1 mt-4">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error') || $errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Oops!</strong>
                    </div>
                    @if(session('error'))
                        <div class="mt-2">{{ session('error') }}</div>
                    @else
                        <ul class="mb-0 mt-2 ps-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <button type="button" class="btn-close position-absolute top-0 end-0 mt-2 me-3" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </main>

    <footer class="footer-custom">
        <div class="footer-pattern"></div>
        <div class="container footer-content">
            <div class="row">
                <div class="col-lg-5 col-md-6 mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <a href="{{ route('home') }}" class="d-inline-block">
                            <img src="{{ asset('img/Lambang_Kabupaten_Purworejo.png') }}" alt="Logo Kabupaten Purworejo" class="footer-logo me-3">
                        </a>
                        <div>
                            <h5 class="footer-title">SIKUM</h5>
                            <p class="footer-subtitle">Pemerintah Kabupaten Purworejo</p>
                        </div>
                    </div>
                    <p class="footer-description">
                        Sistem Informasi Hukum adalah aplikasi berbasis web yang digunakan untuk melihat dan menelusuri proses penyusunan serta pengelolaan dokumen hukum secara terpusat. Aplikasi ini memudahkan pengguna dalam mengakses informasi hukum yang lengkap, akurat, dan terstruktur.
                    </p>
                    <div class="footer-social-icons">
                        <a href="https://www.instagram.com/purworejokab_/" class="footer-social-icon" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/@pemkabpurworejo8120" class="footer-social-icon" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-youtube"></i>
                        </a>
                        <a href="https://www.purworejokab.go.id/web/home.html" class="footer-social-icon" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-globe"></i>
                        </a>
                        <a href="https://x.com/purworejokab_" class="footer-social-icon" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <h6 class="footer-section-title">Hubungi Kami</h6>
                    <div class="footer-contact-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Jl. Proklamasi No. 2 Purworejo</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="bi bi-telephone-fill"></i>
                        <span>(0275) 321493</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="bi bi-envelope-fill"></i>
                        <span>dinkominfo@purworejokab.go.id</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="footer-section-title">Informasi</h6>
                    <p class="footer-description">
                        Sistem Informasi Hukum adalah aplikasi berbasis web yang digunakan untuk melihat dan menelusuri proses penyusunan serta pengelolaan dokumen hukum secara terpusat. Aplikasi ini memudahkan pengguna dalam mengakses informasi hukum yang lengkap, akurat, dan terstruktur.
                    </p>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="footer-bottom-text">
                            © 2025 SIKUM - Kabupaten Purworejo. All rights reserved.
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="footer-developer">
                            Developed by <a href="https://www.linkedin.com/in/rahmatirfan/" target="_blank" rel="noopener noreferrer">Rahmat Irfan Adie Purwatmoko</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-close alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert-dismissible');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
            
            // Handle submenu on mobile
            const isMobile = window.matchMedia("(max-width: 991.98px)").matches;
            if (isMobile) {
                document.querySelectorAll('.dropdown-submenu > a').forEach(item => {
                    item.addEventListener('click', function(e) {
                        if (this.parentElement.querySelector('.dropdown-submenu-content').style.display === 'block') {
                            e.preventDefault();
                        }
                        this.parentElement.querySelector('.dropdown-submenu-content').style.display = 
                            this.parentElement.querySelector('.dropdown-submenu-content').style.display === 'block' ? 'none' : 'block';
                    });
                });
            }
        });
    </script>
    @yield('scripts')
</body>
</html>