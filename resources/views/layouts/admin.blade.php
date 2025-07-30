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
            overflow-y: auto;
        }
        #sidebar-wrapper .sidebar-heading {
            padding: 1.5rem;
            font-size: 1.25rem;
            font-weight: bold;
            color: #fff;
            border-bottom: 1px solid #495057;
        }
        
        /* Menu Item Styles */
        .menu-item {
            background-color: #343a40;
            color: #adb5bd;
            border: none;
            padding: 1rem 1.5rem;
            transition: all 0.2s ease-in-out;
            text-decoration: none;
            display: block;
            cursor: pointer;
        }
        
        .menu-item:hover,
        .menu-item.active {
            background-color: #495057;
            color: #fff;
            border-left: 3px solid #0d6efd;
            text-decoration: none;
        }
        
        /* Dropdown Menu Styles */
        .dropdown-menu-item {
            background-color: #343a40;
            color: #adb5bd;
            border: none;
            padding: 1rem 1.5rem;
            transition: all 0.2s ease-in-out;
            text-decoration: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }
        
        .dropdown-menu-item:hover,
        .dropdown-menu-item.active {
            background-color: #495057;
            color: #fff;
            text-decoration: none;
        }
        
        .dropdown-arrow {
            transition: transform 0.2s ease-in-out;
        }
        
        .dropdown-arrow.rotated {
            transform: rotate(90deg);
        }
        
        /* Submenu Styles */
        .submenu {
            background-color: #2c3237;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }
        
        .submenu.show {
            max-height: 300px;
        }
        
        .submenu-item {
            background-color: #2c3237;
            color: #adb5bd;
            border: none;
            padding: 0.75rem 2.5rem;
            transition: all 0.2s ease-in-out;
            text-decoration: none;
            display: block;
            border-left: 2px solid transparent;
        }
        
        .submenu-item:hover,
        .submenu-item.active {
            background-color: #495057;
            color: #fff;
            border-left: 2px solid #0d6efd;
            text-decoration: none;
        }
        
        #page-content-wrapper {
            flex: 1;
            padding: 20px;
        }
        
        /* Custom scrollbar for sidebar */
        #sidebar-wrapper::-webkit-scrollbar {
            width: 4px;
        }
        
        #sidebar-wrapper::-webkit-scrollbar-track {
            background: #343a40;
        }
        
        #sidebar-wrapper::-webkit-scrollbar-thumb {
            background: #6c757d;
            border-radius: 2px;
        }
        
        #sidebar-wrapper::-webkit-scrollbar-thumb:hover {
            background: #adb5bd;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <div class="sidebar-heading text-center">Admin SIKUM</div>
            <div class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt fa-fw me-2"></i>Dashboard
            </a>

            <div class="dropdown-menu-item {{ request()->routeIs('admin.opd.*') || request()->routeIs('admin.user.*') || request()->routeIs('admin.asisten.*') || request()->routeIs('admin.admin.*') ? 'active' : '' }}" onclick="toggleDropdown('userManagement')">
                <span><i class="fas fa-users fa-fw me-2"></i>Data Master</span>
                <i class="fas fa-chevron-right dropdown-arrow" id="userManagement-arrow"></i>
            </div>
            <div class="submenu {{ request()->routeIs('admin.opd.*') || request()->routeIs('admin.user.*') || request()->routeIs('admin.asisten.*') || request()->routeIs('admin.admin.*') ? 'show' : '' }}" id="userManagement-submenu">
                <a href="{{ route('admin.opd.index') }}" class="submenu-item {{ request()->routeIs('admin.opd.*') ? 'active' : '' }}">
                    <i class="fas fa-building fa-fw me-2"></i>Manajemen OPD
                </a>
                @if(Auth::guard('admin')->user()->role == 'superadmin')
                <a href="{{ route('admin.user.index') }}" class="submenu-item {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                    <i class="fas fa-user fa-fw me-2"></i>Manajemen User
                </a>
                @endif
                <a href="{{ route('admin.asisten.index') }}" class="submenu-item {{ request()->routeIs('admin.asisten.*') ? 'active' : '' }}">
                    <i class="fas fa-user-tie fa-fw me-2"></i>Manajemen Asisten
                </a>
                @if(Auth::guard('admin')->user()->role == 'superadmin')
                <a href="{{ route('admin.admin.index') }}" class="submenu-item {{ request()->routeIs('admin.admin.*') ? 'active' : '' }}">
                    <i class="fas fa-users-cog fa-fw me-2"></i>Manajemen Admin
                </a>
                @endif
            </div>

            <div class="dropdown-menu-item {{ request()->routeIs('admin.nomorsk.*') || request()->routeIs('admin.prosessk.*') ? 'active' : '' }}" onclick="toggleDropdown('skManagement')">
                <span><i class="fas fa-file-alt fa-fw me-2"></i>Manajemen SK</span>
                <i class="fas fa-chevron-right dropdown-arrow" id="skManagement-arrow"></i>
            </div>
            <div class="submenu {{ request()->routeIs('admin.nomorsk.*') || request()->routeIs('admin.prosessk.*') ? 'show' : '' }}" id="skManagement-submenu">
                <a href="{{ route('admin.nomorsk.index') }}" class="submenu-item {{ request()->routeIs('admin.nomorsk.*') ? 'active' : '' }}">
                    <i class="fas fa-hashtag fa-fw me-2"></i>Manajemen Nomor SK
                </a>
                <a href="{{ route('admin.prosessk.index') }}" class="submenu-item {{ request()->routeIs('admin.prosessk.*') ? 'active' : '' }}">
                    <i class="fas fa-cogs fa-fw me-2"></i>Manajemen Proses SK
                </a>
            </div>

            <div class="dropdown-menu-item {{ request()->routeIs('admin.nomorperbup.*') || request()->routeIs('admin.prosesperbup.*') ? 'active' : '' }}" onclick="toggleDropdown('perbupManagement')">
                <span><i class="fas fa-file-contract fa-fw me-2"></i>Manajemen Perbup</span>
                <i class="fas fa-chevron-right dropdown-arrow" id="perbupManagement-arrow"></i>
            </div>
            <div class="submenu {{ request()->routeIs('admin.nomorperbup.*') || request()->routeIs('admin.prosesperbup.*') ? 'show' : '' }}" id="perbupManagement-submenu">
                <a href="{{ route('admin.nomorperbup.index') }}" class="submenu-item {{ request()->routeIs('admin.nomorperbup.*') ? 'active' : '' }}">
                    <i class="fas fa-hashtag fa-fw me-2"></i>Manajemen Nomor Perbup
                </a>
                <a href="{{ route('admin.prosesperbup.index') }}" class="submenu-item {{ request()->routeIs('admin.prosesperbup.*') ? 'active' : '' }}">
                    <i class="fas fa-cogs fa-fw me-2"></i>Manajemen Proses Perbup
                </a>
            </div>

            <a href="{{ route('admin.proseslain.index') }}" class="menu-item {{ request()->routeIs('admin.proseslain.*') ? 'active' : '' }}">
                <i class="fas fa-file-signature fa-fw me-2"></i>SK Lainnya
            </a>

            <a href="{{ route('logout') }}" class="menu-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
    
    <script>
        function toggleDropdown(menuId) {
            const submenu = document.getElementById(menuId + '-submenu');
            const arrow = document.getElementById(menuId + '-arrow');
            
            if (submenu.classList.contains('show')) {
                submenu.classList.remove('show');
                arrow.classList.remove('rotated');
            } else {
                // Close all other dropdowns
                document.querySelectorAll('.submenu').forEach(menu => {
                    menu.classList.remove('show');
                });
                document.querySelectorAll('.dropdown-arrow').forEach(arr => {
                    arr.classList.remove('rotated');
                });
                
                // Open clicked dropdown
                submenu.classList.add('show');
                arrow.classList.add('rotated');
            }
        }

        // Auto-expand dropdown if current page is in submenu
        document.addEventListener('DOMContentLoaded', function() {
            const activeSubmenus = document.querySelectorAll('.submenu.show');
            activeSubmenus.forEach(submenu => {
                const menuId = submenu.id.replace('-submenu', '');
                const arrow = document.getElementById(menuId + '-arrow');
                if (arrow) {
                    arrow.classList.add('rotated');
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>