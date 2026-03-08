<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Admin Panel') — {{ config('app.name') }}</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <style>
        :root {
            --primary: {{ \App\Models\Setting::get('primary_color', '#b8962b') }};
            --primary-dark: #8a6f1e;
            --sidebar-width: 260px;
        }
        body { background: #f5f6fa; font-family: 'Segoe UI', sans-serif; }

        /* Sidebar */
        .admin-sidebar {
            position: fixed; top: 0; left: 0;
            width: var(--sidebar-width); height: 100vh;
            background: #1a1a2e; color: #fff;
            overflow-y: auto; z-index: 1000;
            transition: transform 0.3s ease;
        }
        .sidebar-brand {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-brand img { max-height: 40px; }
        .sidebar-brand h5 { color: var(--primary); margin: 0; font-weight: 700; }

        .sidebar-nav { padding: 1rem 0; }
        .nav-section-label {
            font-size: 0.7rem; font-weight: 600; letter-spacing: 1px;
            color: rgba(255,255,255,0.4); padding: 0.75rem 1.25rem 0.25rem;
            text-transform: uppercase;
        }
        .sidebar-nav .nav-link {
            color: rgba(255,255,255,0.75); padding: 0.65rem 1.25rem;
            display: flex; align-items: center; gap: 0.75rem;
            border-radius: 0; transition: all 0.2s;
            font-size: 0.9rem;
        }
        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active {
            color: #fff; background: rgba(255,255,255,0.08);
            border-left: 3px solid var(--primary);
            padding-left: calc(1.25rem - 3px);
        }
        .sidebar-nav .nav-link i { width: 20px; text-align: center; }

        /* Topbar */
        .admin-topbar {
            margin-left: var(--sidebar-width);
            background: #fff; border-bottom: 1px solid #e9ecef;
            padding: 0.75rem 1.5rem;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 999;
        }

        /* Main content */
        .admin-main {
            margin-left: var(--sidebar-width);
            padding: 1.5rem;
            min-height: calc(100vh - 60px);
        }

        /* Stats cards */
        .stat-card {
            border-radius: 12px; border: none;
            background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-2px); }
        .stat-card .icon-box {
            width: 50px; height: 50px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
        }

        /* Page title */
        .page-title { font-weight: 700; color: #1a1a2e; margin-bottom: 0; }
        .breadcrumb { font-size: 0.85rem; margin: 0; }

        /* Alert messages */
        .alert { border-radius: 10px; border: none; }

        /* Btn primary */
        .btn-admin-primary {
            background: var(--primary); color: #fff; border: none;
            border-radius: 8px; padding: 0.5rem 1.25rem;
        }
        .btn-admin-primary:hover { background: var(--primary-dark); color: #fff; }

        @media (max-width: 992px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.show { transform: translateX(0); }
            .admin-topbar, .admin-main { margin-left: 0; }
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Sidebar --}}
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            @php $logo = \App\Models\Setting::get('logo'); @endphp
            @if($logo)
                <img src="{{ asset('storage/' . $logo) }}" alt="{{ config('app.name') }}" />
            @else
                <h5><i class="fas fa-building me-2"></i>{{ config('app.name') }}</h5>
            @endif
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>

            <div class="nav-section-label">Content</div>
            <a href="#" class="nav-link">
                <i class="fas fa-building"></i> Properties
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-blog"></i> Blog Posts
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-users"></i> Team Members
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-cogs"></i> Services
            </a>

            <div class="nav-section-label">Leads</div>
            <a href="#" class="nav-link">
                <i class="fas fa-envelope"></i> Leads / Inquiries
            </a>

            <div class="nav-section-label">Administration</div>
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-user-shield"></i> Users
            </a>
            <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="fas fa-sliders-h"></i> Settings
            </a>
        </nav>
    </aside>

    {{-- Topbar --}}
    <header class="admin-topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-sm btn-outline-secondary d-lg-none" onclick="document.getElementById('adminSidebar').classList.toggle('show')">
                <i class="fas fa-bars"></i>
            </button>
            <div>
                <h6 class="page-title">@yield('page-title', 'Dashboard')</h6>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                        @yield('breadcrumb')
                    </ol>
                </nav>
            </div>
        </div>

        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary" target="_blank">
                <i class="fas fa-external-link-alt me-1"></i>View Site
            </a>
            <div class="dropdown">
                <button class="btn btn-sm d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                    <img src="{{ auth()->user()->avatar_url }}" class="rounded-circle" width="32" height="32" alt="Avatar" />
                    <span>{{ auth()->user()->name }}</span>
                    <i class="fas fa-chevron-down fa-xs"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                    <li><h6 class="dropdown-header">{{ auth()->user()->email }}</h6></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="admin-main">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
