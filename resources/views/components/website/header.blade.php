@php
    $logo      = $site['logo'] ?? null;
    $siteName  = $site['site_name'] ?? config('app.name');
    $phoneMain = $site['phone_primary'] ?? '';
@endphp

<!-- Header Start -->
<header class="main-header">
    <div class="header-sticky bg-section dark-section" style="background-color: #1a1a1a !important;">
        <nav class="navbar navbar-expand-lg" style="background-color: #1a1a1a !important;">
            <style>
                .navbar .nav-link {
                    color: #ffffff !important;
                }
                .navbar .nav-link:hover {
                    color: var(--primary-color) !important;
                }
                .navbar .nav-link.active {
                    color: var(--primary-color) !important;
                }
                .header-btn .btn-default {
                    background-color: #ffffff !important;
                    color: #000000 !important;
                    border: 1px solid #ffffff !important;
                }
                .header-btn .btn-default:hover {
                    background-color: transparent !important;
                    color: #ffffff !important;
                }
                .navbar-toggle {
                    filter: brightness(0) invert(1);
                }
            </style>
            <div class="container">
                <!-- Logo Start -->
                <a class="navbar-brand" href="{{ route('home') }}">
                    @if($logo)
                        <img src="{{ $logo }}" alt="{{ $siteName }}" style="max-height: 50px; width: auto; object-fit: contain;" />
                    @else
                        <img src="{{ asset('images/logo.svg') }}" alt="{{ $siteName }}" style="max-height: 50px; width: auto; object-fit: contain;" />
                    @endif
                </a>
                <!-- Logo End -->

                <!-- Main Menu Start -->
                <div class="collapse navbar-collapse main-menu">
                    <div class="nav-menu-wrapper">
                        @php
                            $headerMenu = $navigationService->getMenu('header-menu');
                        @endphp
                        <ul class="navbar-nav mr-auto" id="menu">
                            @if($headerMenu)
                                @foreach($headerMenu['items'] as $item)
                                    @include('components.website.header-menu-item', ['item' => $item])
                                @endforeach
                            @else
                                <!-- Fallback: hardcoded menu items if database menu not available -->
                                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('about') }}">About</a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('projects.*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('projects.index') }}">Properties</a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('blog.*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('blog.index') }}">Blogs</a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <!-- Header Btn Start -->
                    <div class="header-btn">
                        <a href="{{ route('contact') }}" class="btn-default">Get Free Quote</a>
                    </div>
                    <!-- Header Btn End -->
                </div>
                <!-- Main Menu End -->
                <div class="navbar-toggle"></div>
            </div>
        </nav>
        <div class="responsive-menu"></div>
    </div>
</header>
<!-- Header End -->
