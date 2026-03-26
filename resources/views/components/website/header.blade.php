@php
    $logo      = $site['logo'] ?? null;
    $siteName  = $site['site_name'] ?? config('app.name');
    $phoneMain = $site['phone_primary'] ?? '';
@endphp

<!-- Header Start -->
<header class="main-header">
    <div class="header-sticky bg-section">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Logo + Tagline Start -->
                <div class="d-flex align-items-center gap-3" style="flex-shrink:0;">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        @if($logo)
                            <img src="{{ $logo }}" alt="{{ $siteName }}" style="max-height: 100px; width: auto; object-fit: contain;" />
                        @else
                            <img src="{{ asset('images/logo.svg') }}" alt="{{ $siteName }}" style="max-height: 100px; width: auto; object-fit: contain;" />
                        @endif
                    </a>
                    <span class="navbar-tagline d-none d-lg-block" style="font-size:12px; font-weight:700; color:var(--accent-secondary-color); letter-spacing:0.08em; text-transform:uppercase; line-height:1.3; border-left:2px solid var(--accent-secondary-color); padding-left:12px;">Invest<br>in India</span>
                </div>
                <!-- Logo + Tagline End -->

                <!-- Main Menu Start -->
                <div class="collapse navbar-collapse main-menu justify-content-end">
                    <div class="nav-menu-wrapper" style="flex:0 0 auto;">
                        <!-- Hardcoded menu items -->
                        <ul class="navbar-nav" id="menu">
                            <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('about') }}">About</a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('website.projects.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('website.projects.index') }}">Projects</a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('blog.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('blog.index') }}">Blog</a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('calculator') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('calculator') }}">EMI Calculator</a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('gallery.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('gallery.index') }}">Gallery</a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Header Btn Start -->
                    <div class="header-btn">
                        <a href="{{ route('contact') }}" class="btn-default btn-navbar">Partner With Us</a>
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
