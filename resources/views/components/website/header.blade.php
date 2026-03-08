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
                <!-- Logo Start -->
                <a class="navbar-brand" href="{{ route('home') }}">
                    @if($logo)
                        <img src="{{ asset('storage/' . $logo) }}" alt="{{ $siteName }}" />
                    @else
                        <img src="{{ asset('images/logo.svg') }}" alt="{{ $siteName }}" />
                    @endif
                </a>
                <!-- Logo End -->

                <!-- Main Menu Start -->
                <div class="collapse navbar-collapse main-menu">
                    <div class="nav-menu-wrapper">
                        <ul class="navbar-nav mr-auto" id="menu">
                            <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('about') }}">About Us</a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('services') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('services') }}">Services</a>
                            </li>
                            <li class="nav-item submenu {{ request()->routeIs('projects.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('projects.index') }}">Projects</a>
                                <ul>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('projects.index') }}">All Projects</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item submenu {{ request()->routeIs('blog.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('blog.index') }}">Blog</a>
                                <ul>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('blog.index') }}">All Posts</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item {{ request()->routeIs('team') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('team') }}">Our Team</a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
                            </li>
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
