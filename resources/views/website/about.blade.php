@extends('layouts.website')
@section('title', 'About Us - ' . ($site['site_name'] ?? config('app.name')))
@section('content')

<!-- Page Header Start -->
@php $breadcrumbBg = \App\Models\Setting::get('breadcrumb_bg'); @endphp
<div class="page-header bg-section parallaxie" style="background-image: url({{ $breadcrumbBg ? asset('uploads/' . $breadcrumbBg) : asset('images/page-header-bg.jpg') }}); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center 9px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque">About Us</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('about') }}">About Us</a></li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- About Us Section Start -->
<div class="about-us" style="margin: 12px 0;">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-xl-7">
                <div class="section-title">
                    <span class="section-sub-title wow fadeInUp">About i3 Realtors</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">
                        Trusted Real Estate Mandate <span>Partners for Developers</span>
                    </h2>
                </div>
            </div>
            <div class="col-xl-5">
                <div class="section-content-btn">
                    <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                        <p>i3 Realtors is a mandate-focused real estate consulting firm specializing in developer partnerships, project marketing, and structured real estate investments.</p>
                    </div>
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.4s">
                        <a href="{{ route('about') }}" class="btn-default">Learn More About</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="about-us-image-box wow fadeInUp">
                    <div class="about-us-image">
                        <figure class="image-anime">
                            @php $aboutMainImg = \App\Models\Setting::get('about_main_image'); @endphp
                            <img src="{{ $aboutMainImg ? asset('uploads/' . $aboutMainImg) : asset('images/who-we-are-image-1.jpeg') }}" alt="About i3Realtors" />
                        </figure>
                    </div>
                    <div class="about-us-circle">
                        <a href="{{ route('website.projects.index') }}">
                            <img src="{{ asset('images/circle-project.png') }}" alt="" />
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="about-us-content-box wow fadeInUp" data-wow-delay="0.2s">
                    <div class="about-us-item-list">
                        <div class="about-us-item box-1">
                            <div class="about-us-item-content">
                                <h3>Strategic Market Understanding</h3>
                                <p>We analyze market trends and buyer behavior to position projects for optimal visibility</p>
                            </div>
                            <div class="about-us-item-image">
                                <figure>
                                    @php $aboutItem1 = \App\Models\Setting::get('about_item_image_1'); @endphp
                                    <img src="{{ $aboutItem1 ? asset('uploads/' . $aboutItem1) : asset('images/about-us-item-image-1.png') }}" alt="" />
                                </figure>
                            </div>
                        </div>

                        <div class="about-us-item box-2">
                            <div class="about-us-item-content">
                                <h3>Investor Network</h3>
                                <p>Through a growing network of investors and partners, we connect the right opportunities with stakeholders</p>
                            </div>
                            <div class="about-us-item-image">
                                <figure class="image-anime">
                                    @php $aboutItem2 = \App\Models\Setting::get('about_item_image_2'); @endphp
                                    <img src="{{ $aboutItem2 ? asset('uploads/' . $aboutItem2) : asset('images/who-we-are-image-2.jpg') }}" alt="" />
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About Us Section End -->

<!-- Leadership Team Section Start -->
<div style="background: #f9f9f9; padding: 100px 0;">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <div class="section-title section-title-center">
                    <span class="section-sub-title wow fadeInUp">Meet the Team</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">Leadership <span>Team</span></h2>
                </div>
            </div>
        </div>

        @if(isset($teamMembers) && $teamMembers->isNotEmpty())
        <div class="row g-4 justify-content-center">
            @foreach($teamMembers as $i => $member)
            <div class="col-xl-4 col-md-6">
                <div class="wow fadeInUp" data-wow-delay="{{ ['','0.2s','0.4s','0.6s'][$i] ?? '' }}"
                     style="background:#ffffff; border-radius:12px; overflow:hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.07); height:100%;">
                    @if($member->profile_image)
                    <div style="height:260px; overflow:hidden;">
                        <img src="{{ asset('uploads/' . $member->profile_image) }}" alt="{{ $member->full_name }}"
                             style="width:100%; height:100%; object-fit:cover; object-position: top;">
                    </div>
                    @else
                    <div style="height:220px; background: linear-gradient(135deg, #1a1a1a, #2d2d2d); display:flex; align-items:center; justify-content:center;">
                        <span style="font-size:64px; font-weight:700; color: var(--accent-secondary-color);">{{ strtoupper(substr($member->first_name, 0, 1)) }}</span>
                    </div>
                    @endif
                    <div style="padding:28px;">
                        <h3 style="font-size:20px; font-weight:700; color:#111; margin:0 0 4px;">{{ $member->full_name }}</h3>
                        <p style="color: var(--accent-secondary-color); font-size:13px; font-weight:700; margin:0 0 16px; text-transform:uppercase; letter-spacing:0.5px;">{{ $member->position }}</p>
                        @if($member->bio)
                        <p style="color:#666; font-size:14px; line-height:1.7; margin:0 0 20px;">{{ $member->bio }}</p>
                        @endif
                        @if($member->linkedin_url)
                        <a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener noreferrer"
                           style="display:inline-flex; align-items:center; gap:6px; color: var(--accent-secondary-color); font-size:13px; font-weight:600; text-decoration:none;">
                            <i class="fa-brands fa-linkedin-in"></i> LinkedIn Profile
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        {{-- Hardcoded leadership content as default --}}
        <div class="row g-4 justify-content-center">
            @php
            $leaders = [
                [
                    'name' => 'Ankit Nigam',
                    'designation' => 'Founder & Managing Director',
                    'description' => '14+ years of experience in real estate builder relations and mandate partnerships. Worked with leading developers like Shapoorji Pallonji, Puranik, and Gagan Developers.',
                    'stats' => '1.1 Million Sq.ft sold | ₹770+ Cr business value',
                ],
                [
                    'name' => 'Pravin Kolte',
                    'designation' => 'Director – Strategy',
                    'description' => '14+ years of experience in real estate sales strategy and developer partnerships. Handled multiple residential and commercial mandates across Pune, Mumbai, and Raigad.',
                    'stats' => '2.4 Million Sq.ft sold | ₹1700+ Cr business value',
                ],
                [
                    'name' => 'Shrikant Potale',
                    'designation' => 'Director – Sales & Marketing',
                    'description' => '12+ years of experience in builder relations and sales execution. Worked with Kumar Properties, Kolte Patil, and Mantra.',
                    'stats' => '1 Million Sq.ft sold | ₹600+ Cr business value',
                ],
            ];
            @endphp
            @foreach($leaders as $i => $leader)
            <div class="col-xl-4 col-md-6">
                <div class="wow fadeInUp" data-wow-delay="{{ ['','0.2s','0.4s'][$i] }}"
                     style="background:#ffffff; border-radius:12px; overflow:hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.07); height:100%;">
                    <div style="height:180px; background: linear-gradient(135deg, #111111, #2a2a2a); display:flex; align-items:center; justify-content:center;">
                        <span style="font-size:64px; font-weight:700; color: var(--accent-secondary-color);">{{ strtoupper(substr($leader['name'], 0, 1)) }}</span>
                    </div>
                    <div style="padding:28px;">
                        <h3 style="font-size:20px; font-weight:700; color:#111; margin:0 0 4px;">{{ $leader['name'] }}</h3>
                        <p style="color: var(--accent-secondary-color); font-size:13px; font-weight:700; margin:0 0 12px; text-transform:uppercase; letter-spacing:0.5px;">{{ $leader['designation'] }}</p>
                        <p style="color:#666; font-size:14px; line-height:1.7; margin:0 0 12px;">{{ $leader['description'] }}</p>
                        <p style="color:#999; font-size:12px; font-weight:600; border-top: 1px solid #f0f0f0; padding-top:12px; margin:0;">{{ $leader['stats'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
<!-- Leadership Team Section End -->

<!-- Achievements Section Start -->
<div style="padding: 100px 0; background: #f5f5f5;">
    <div class="container-fluid px-4 px-lg-5">
        <div class="row section-row">
            <div class="col-lg-12">
                <div class="section-title section-title-center">
                    <span class="section-sub-title wow fadeInUp">Our Track Record</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">Achievements</h2>
                </div>
            </div>
        </div>

        @if(isset($achievements) && $achievements->isNotEmpty())
        <div class="wow fadeInUp" data-wow-delay="0.2s" style="position:relative; margin-top:40px;">

            {{-- Prev/Next buttons --}}
            <button id="achPrev" onclick="scrollAch(-1)"
                    style="position:absolute; left:-10px; top:50%; transform:translateY(-50%); z-index:10; width:44px; height:44px; border-radius:50%; background:var(--accent-secondary-color); border:none; color:#fff; font-size:16px; cursor:pointer; box-shadow:0 2px 8px rgba(0,0,0,0.2);">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button id="achNext" onclick="scrollAch(1)"
                    style="position:absolute; right:-10px; top:50%; transform:translateY(-50%); z-index:10; width:44px; height:44px; border-radius:50%; background:var(--accent-secondary-color); border:none; color:#fff; font-size:16px; cursor:pointer; box-shadow:0 2px 8px rgba(0,0,0,0.2);">
                <i class="fas fa-chevron-right"></i>
            </button>

            <div id="achTrack" style="display:flex; gap:20px; overflow:hidden; scroll-behavior:smooth; padding: 10px 4px 20px;">
                @foreach($achievements as $achievement)
                <div style="flex:0 0 calc(25% - 15px); min-width:220px;">
                    {{-- Card --}}
                    <div style="background:#fff; border-radius:8px; overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,0.10); height:100%;">

                        {{-- Gray header with developer name --}}
                        <div style="background:#6b6b6b; padding:18px 16px 16px; text-align:center; position:relative; clip-path: polygon(0 0, 100% 0, 100% 85%, 50% 100%, 0 85%);">
                            <h3 style="color:#fff; font-size:17px; font-weight:800; letter-spacing:0.5px; margin:0; line-height:1.3; text-transform:uppercase;">{{ $achievement->title }}</h3>
                        </div>

                        {{-- Logo --}}
                        <div style="padding:20px 16px 12px; text-align:center; min-height:110px; display:flex; align-items:center; justify-content:center;">
                            @if($achievement->image)
                                <img src="{{ asset('uploads/' . $achievement->image) }}" alt="{{ $achievement->title }}"
                                     style="max-height:80px; max-width:100%; object-fit:contain;">
                            @else
                                <div style="width:80px; height:80px; background:#f0f0f0; border-radius:50%; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-building" style="font-size:28px; color:#bbb;"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Stats --}}
                        <div style="padding:4px 20px 24px; font-size:14px; line-height:2;">
                            @if($achievement->units)
                            <p style="margin:0; color:#e05a00; font-weight:600;">No of Units – {{ $achievement->units }}</p>
                            @endif
                            @if($achievement->sales_value)
                            <p style="margin:0; color:#e05a00; font-weight:600;">Sales Value – {{ $achievement->sales_value }}</p>
                            @endif
                            @if($achievement->sold_percentage)
                            <p style="margin:0; color:#e05a00; font-weight:600;">Sold – {{ $achievement->sold_percentage }}</p>
                            @endif
                            @if($achievement->time_period)
                            <p style="margin:0; color:#e05a00; font-weight:600;">Time - {{ $achievement->time_period }}</p>
                            @endif
                            @if($achievement->location)
                            <p style="margin:0; color:#e05a00; font-weight:600;">{{ $achievement->location }}</p>
                            @endif
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.2s">
            <div class="col-lg-6 text-center">
                <p style="color:#aaa; font-size:15px;">Achievements coming soon.</p>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Achievements Section End -->

@push('scripts')
<script>
(function() {
    var track     = document.getElementById('achTrack');
    var cardWidth = 0;

    function getCardWidth() {
        var first = track && track.firstElementChild;
        return first ? first.offsetWidth + 20 : 260;
    }

    window.scrollAch = function(dir) {
        cardWidth = getCardWidth();
        track.scrollLeft += dir * cardWidth * 4;
    };
})();
</script>
@endpush

@if(isset($galleryImages) && $galleryImages->isNotEmpty())
<!-- Team Gallery Carousel Section Start -->
<div style="padding: 100px 0; background: #ffffff;">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <div class="section-title section-title-center">
                    <span class="section-sub-title wow fadeInUp">Our Team</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">Life at i3 Realtors</h2>
                </div>
            </div>
        </div>

        <div class="wow fadeInUp" data-wow-delay="0.2s">
            <div id="teamGalleryCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    @foreach($galleryImages->chunk(3) as $chunkIndex => $chunk)
                    <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                        <div class="row g-3">
                            @foreach($chunk as $image)
                            <div class="{{ $chunk->count() === 1 ? 'col-12' : ($chunk->count() === 2 ? 'col-md-6' : 'col-md-4') }}">
                                <div style="border-radius:12px; overflow:hidden; height:320px;">
                                    <img src="{{ asset('uploads/' . $image->image_path) }}"
                                         alt="{{ $image->caption ?? 'Team' }}"
                                         style="width:100%; height:100%; object-fit:cover;">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

                @if($galleryImages->count() > 3)
                <button class="carousel-control-prev" type="button" data-bs-target="#teamGalleryCarousel" data-bs-slide="prev"
                        style="width:48px; height:48px; background: var(--accent-secondary-color); border-radius:50%; top:50%; transform:translateY(-50%); left:-24px; opacity:1;">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#teamGalleryCarousel" data-bs-slide="next"
                        style="width:48px; height:48px; background: var(--accent-secondary-color); border-radius:50%; top:50%; transform:translateY(-50%); right:-24px; opacity:1;">
                    <span class="carousel-control-next-icon"></span>
                </button>
                @endif

                @if($galleryImages->count() > 3)
                <div class="carousel-indicators" style="bottom:-40px;">
                    @foreach($galleryImages->chunk(3) as $chunkIndex => $chunk)
                    <button type="button" data-bs-target="#teamGalleryCarousel" data-bs-slide-to="{{ $chunkIndex }}"
                            class="{{ $chunkIndex === 0 ? 'active' : '' }}"
                            style="width:8px; height:8px; border-radius:50%; background: {{ $chunkIndex === 0 ? 'var(--accent-secondary-color)' : '#ccc' }}; border:none; margin:0 4px;">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Team Gallery Carousel Section End -->
@endif

<!-- Our Approach Section Start -->
<div class="our-approach bg-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6">
                <!-- Our Approach Images Start -->
                <div class="our-approach-images">
                    <!-- Our Approach Image Box-1 Start -->
                    <div class="our-approach-image-box-1">
                        <!-- Our Approach Image Start -->
                        <div class="our-approach-image">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('images/our-approach-image-1.jpg') }}" alt="">
                            </figure>
                        </div>
                        <!-- Our Approach Image End -->
                    </div>
                    <!-- Our Approach Image Box-1 End -->

                    <!-- Our Approach Image Box-2 Start -->
                    <div class="our-approach-image-box-2">
                        <!-- Our Approach Image Start -->
                        <div class="our-approach-image">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('images/our-approach-image-2.jpg') }}" alt="">
                            </figure>
                        </div>
                        <!-- Our Approach Image End -->
                    </div>
                    <!-- Our Approach Image Box-2 End -->
                </div>
                <!-- Our Approach Images End -->
            </div>

            <div class="col-xl-6">
                <!-- Our Approach Content Start -->
                <div class="our-approach-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <span class="section-sub-title wow fadeInUp">Our Approach</span>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">A Strategic Approach to Real Estate Partnerships</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">At i3 Realtors, we follow a structured approach that combines market intelligence, strategic marketing, and strong developer relationships to ensure every project receives the right visibility and positioning it deserves.</p>
                        <p class="wow fadeInUp" data-wow-delay="0.3s">Our goal is to build long-term partnerships with developers and investors by delivering consistent results and transparent collaboration.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Our Approach Item Box Start -->
                    <div class="approach-item-box">
                        <!-- Our Approach Item Start -->
                        <div class="approach-item wow fadeInUp">
                            <div class="icon-box">
                                <img src="{{ asset('images/icon-approach-item-1.svg') }}" alt="">
                            </div>
                            <div class="approach-item-content">
                                <h3>Our Mission</h3>
                                <p>To empower developers and investors by creating structured real estate opportunities that deliver long-term growth, transparency, and strategic value.</p>
                            </div>
                        </div>
                        <!-- Our Approach Item End -->

                        <!-- Our Approach Item Start -->
                        <div class="approach-item wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon-box">
                                <img src="{{ asset('images/icon-approach-item-2.svg') }}" alt="">
                            </div>
                            <div class="approach-item-content">
                                <h3>Our Vision</h3>
                                <p>To become a trusted mandate partner for developers across India, providing strategic real estate consulting that drives successful project outcomes.</p>
                            </div>
                        </div>
                        <!-- Our Approach Item End -->

                        <!-- Our Approach Item Start -->
                        <div class="approach-item wow fadeInUp" data-wow-delay="0.3s">
                            <div class="icon-box">
                                <img src="{{ asset('images/icon-approach-item-3.svg') }}" alt="">
                            </div>
                            <div class="approach-item-content">
                                <h3>Our Values</h3>
                                <p>Integrity, professionalism, and accountability guide everything we do. We believe in building long-term relationships based on trust, transparency, and consistent performance.</p>
                            </div>
                        </div>
                        <!-- Our Approach Item End -->
                    </div>
                    <!-- Our Approach Item Box End -->
                </div>
                <!-- Our Approach Content End -->
            </div>
        </div>
    </div>
</div>
<!-- Our Approach Section End -->

<!-- Our History Section Start -->
<div class="our-history">
    <div class="container">
        <div class="row">
            <div class="col-xl-4">
                <!-- Our History Content Start -->
                <div class="our-history-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <span class="section-sub-title wow fadeInUp">Our Journey</span>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Building Partnerships and Real Estate Expertise</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">Our journey reflects steady growth, strong developer partnerships, and a commitment to delivering strategic real estate solutions.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Explore Project Circle Start -->
                    <div class="explore-project-circle wow fadeInUp" data-wow-delay="0.4s">
                        <a href="{{ route('website.projects.index') }}">
                            <img src="{{ asset('images/explore-project-circle-accent.svg') }}" alt="">
                        </a>
                    </div>
                    <!-- Explore Project Circle End -->
                </div>
                <!-- Our History Content End -->
            </div>

            <div class="col-xl-8">
                <!-- History Item List Start -->
                <div class="history-item-list">
                    <!-- History Item Start -->
                    <div class="history-item wow fadeInUp">
                        <!-- History Item Header Start -->
                        <div class="history-item-header">
                            <h2>2021</h2>
                            <div class="history-item-content">
                                <h3>Foundation</h3>
                                <p>i3 Realtors was established with a clear vision to support developers and investors through structured real estate consulting and mandate partnerships.</p>
                            </div>
                        </div>
                        <!-- History Item Header End -->

                        <!-- History Item Image Start -->
                        <div class="history-item-image">
                            <figure>
                                <img src="{{ asset('images/our-history-image-1.png') }}" alt="">
                            </figure>
                        </div>
                        <!-- History Item Image End -->
                    </div>
                    <!-- History Item End -->

                    <!-- History Item Start -->
                    <div class="history-item wow fadeInUp" data-wow-delay="0.2s">
                        <!-- History Item Header Start -->
                        <div class="history-item-header">
                            <h2>2023</h2>
                            <div class="history-item-content">
                                <h3>Market Expansion</h3>
                                <p>The company expanded its developer network and began working on multiple residential and commercial projects across Pune.</p>
                            </div>
                        </div>
                        <!-- History Item Header End -->

                        <!-- History Item Image Start -->
                        <div class="history-item-image">
                            <figure>
                                <img src="{{ asset('images/our-history-image-2.png') }}" alt="">
                            </figure>
                        </div>
                        <!-- History Item Image End -->
                    </div>
                    <!-- History Item End -->

                    <!-- History Item Start -->
                    <div class="history-item wow fadeInUp" data-wow-delay="0.4s">
                        <!-- History Item Header Start -->
                        <div class="history-item-header">
                            <h2>2023</h2>
                            <div class="history-item-content">
                                <h3>Strategic Partnerships</h3>
                                <p>i3 Realtors strengthened its mandate-based approach, collaborating with developers and investors to structure projects and marketing strategies.</p>
                            </div>
                        </div>
                        <!-- History Item Header End -->

                        <!-- History Item Image Start -->
                        <div class="history-item-image">
                            <figure>
                                <img src="{{ asset('images/our-history-image-3.png') }}" alt="">
                            </figure>
                        </div>
                        <!-- History Item Image End -->
                    </div>
                    <!-- History Item End -->

                    <!-- History Item Start -->
                    <div class="history-item wow fadeInUp" data-wow-delay="0.6s">
                        <!-- History Item Header Start -->
                        <div class="history-item-header">
                            <h2>Present</h2>
                            <div class="history-item-content">
                                <h3>Continued Growth</h3>
                                <p>Today, i3 Realtors continues to expand its partnerships while focusing on strategic project positioning, investor engagement, and long-term real estate opportunities.</p>
                            </div>
                        </div>
                        <!-- History Item Header End -->

                        <!-- History Item Image Start -->
                        <div class="history-item-image">
                            <figure>
                                <img src="{{ asset('images/our-history-image-1.png') }}" alt="">
                            </figure>
                        </div>
                        <!-- History Item Image End -->
                    </div>
                    <!-- History Item End -->
                </div>
                <!-- History Item List End -->
            </div>
        </div>
    </div>
</div>
<!-- Our History Section End -->

<!-- CTA Box Section Start -->
<div class="cta-box bg-section dark-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 text-center">
                <div class="section-title section-title-center">
                    <span class="section-sub-title wow fadeInUp">Partnership</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">
                        Partner with i3 Realtors for Your Next <span>Real Estate Opportunity</span>
                    </h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">Whether you are a developer launching a new project or an investor exploring structured real estate opportunities, i3 Realtors provides the expertise, market insights, and partnerships required to succeed.</p>
                </div>
                <div class="wow fadeInUp" data-wow-delay="0.4s">
                    <a href="{{ route('contact') }}" class="btn-default btn-highlighted me-3">Connect With Us</a>
                    <a href="{{ route('website.projects.index') }}" class="btn-default">Explore Opportunities</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CTA Box Section End -->

@endsection
