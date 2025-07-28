<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - SIKUM</title>

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
            background-color: #f8f9fa;
        }
        #wrapper {
            display: flex;
            width: 100%;
        }
        #sidebar-wrapper {
            min-height: 100vh;
            width: 250px;
            background-color: #343a40;
            color: #adb5bd;
        }
        #sidebar-wrapper .sidebar-heading {
            padding: 1.5rem;
            font-size: 1.25rem;
            font-weight: bold;
            color: #fff;
            border-bottom: 1px solid #495057;
        }
        #sidebar-wrapper .list-group-item {
            background-color: #343a40;
            color: #adb5bd;
            border: none;
            padding: 1rem 1.5rem;
            transition: all 0.2s ease-in-out;
        }
        #sidebar-wrapper .list-group-item:hover,
        #sidebar-wrapper .list-group-item.active {
            background-color: #495057;
            color: #fff;
            border-left: 3px solid #0d6efd;
        }
        #page-content-wrapper {
            flex: 1;
            padding: 20px;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <div class="sidebar-heading text-center">Admin SIKUM</div>
            <div class="list-group list-group-flush">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt fa-fw me-2"></i>Dashboard
                </a>
                <a href="{{ route('admin.opd.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.opd.*') ? 'active' : '' }}">
                    <i class="fas fa-building fa-fw me-2"></i>Manajemen OPD
                </a>
                <a href="{{ route('admin.user.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                    <i class="fas fa-users fa-fw me-2"></i>Manajemen User
                </a>
                <a href="{{ route('admin.asisten.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.asisten.*') ? 'active' : '' }}">
                    <i class="fas fa-user fa-fw me-2"></i>Manajemen Asisten
                </a>
                <a href="{{ route('admin.admin.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.admin.*') ? 'active' : '' }}">
                    <i class="fas fa-users-cog fa-fw me-2"></i>Manajemen Admin
                </a>
                <a href="{{ route('admin.nomorsk.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.nomorsk.*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt fa-fw me-2"></i>Manajemen Nomor SK
                </a>
                <a href="{{ route('admin.prosessk.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.prosessk.*') ? 'active' : '' }}">
                    <i class="fas fa-cogs fa-fw me-2"></i>Manajemen Proses SK
                </a>
                <a href="{{ route('admin.nomorperbup.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.nomorperbup.*') ? 'active' : '' }}">
                    <i class="fas fa-cogs fa-fw me-2"></i>Manajemen Nomor Perbup
                </a>
                <a href="{{ route('admin.prosesperbup.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.prosesperbup.*') ? 'active' : '' }}">
                    <i class="fas fa-cogs fa-fw me-2"></i>Manajemen Proses Perbup
                </a>
                <a href="{{ route('logout') }}" class="list-group-item list-group-item-action" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-fw me-2"></i>Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
        <div id="page-content-wrapper">
            <main class="py-0">
                 @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>