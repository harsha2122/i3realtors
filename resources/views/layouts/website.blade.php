<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{-- Dynamic SEO --}}
    <meta name="description" content="@yield('meta_description', $site['meta_description'] ?? '')" />
    <meta name="keywords" content="@yield('meta_keywords', $site['meta_keywords'] ?? '')" />

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('title', $site['site_name'] ?? config('app.name'))" />
    <meta property="og:description" content="@yield('meta_description', $site['meta_description'] ?? '')" />
    <meta property="og:type" content="website" />

    {{-- Page Title --}}
    <title>@yield('title', $site['site_name'] ?? config('app.name'))</title>

    {{-- Favicon --}}
    @if(!empty($site['favicon']))
        <link rel="shortcut icon" type="image/x-icon" href="{{ $site['favicon'] }}" />
    @else
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}" />
    @endif

    {{-- Stylesheets (existing theme) --}}
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet" media="screen" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" media="screen" />
    <link href="{{ asset('css/slicknav.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/swiper-bundle.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" media="screen" />
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Dynamic Brand Color CSS Variables --}}
    <style>
        :root {
            --primary-color: {{ $site['primary_color'] ?? '#040618' }};
            --accent-color: {{ $site['primary_color'] ?? '#040618' }};
            --accent-secondary-color: {{ $site['secondary_color'] ?? '#dcff09' }};
        }
    </style>

    {{-- Google Analytics --}}
    @if(!empty($site['google_analytics']))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $site['google_analytics'] }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $site['google_analytics'] }}');
    </script>
    @endif

    {{-- Meta Pixel --}}
    @if(!empty($site['meta_pixel']))
    <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
        n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
        document,'script','https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '{{ $site['meta_pixel'] }}');
        fbq('track', 'PageView');
    </script>
    @endif

    @stack('styles')
</head>
<body>

    {{-- Preloader --}}
    <div class="preloader">
        <div class="loading-container">
            <div class="loading"></div>
            <div id="loading-icon">
                <img src="{{ asset('images/loader.svg') }}" alt="" />
            </div>
        </div>
    </div>

    {{-- Header --}}
    @include('components.website.header')

    {{-- Page Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('components.website.footer')

    {{-- Scripts (existing theme) --}}
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/validator.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('js/parallaxie.js') }}"></script>
    <script src="{{ asset('js/gsap.min.js') }}"></script>
    <script src="{{ asset('js/SplitText.min.js') }}"></script>
    <script src="{{ asset('js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mb.YTPlayer.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/function.js') }}"></script>

    @stack('scripts')
</body>
</html>
