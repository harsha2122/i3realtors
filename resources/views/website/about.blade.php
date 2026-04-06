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
                    <span class="section-sub-title wow fadeInUp">Who We Are</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">
                        Building Real Estate Success, <span>One Partnership at a Time</span>
                    </h2>
                </div>
            </div>
            <div class="col-xl-5">
                <div class="section-content-btn">
                    <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                        <p>Founded with a clear purpose — to bridge the gap between developers and the market — i3 Realtors has grown into a trusted name in mandate-based real estate consulting across Pune and beyond.</p>
                    </div>
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.4s">
                        <a href="{{ route('contact') }}" class="btn-default">Get in Touch</a>
                    </div>
                </div>
            </div>
        </div>

        @php
            $aboutWhoMain  = \App\Models\Setting::get('about_who_main_image');
            $aboutWhoBox1  = \App\Models\Setting::get('about_who_box1_image');
            $aboutWhoBox2  = \App\Models\Setting::get('about_who_box2_image');
        @endphp
        <div class="row">
            <div class="col-xl-6">
                <div class="about-us-image-box wow fadeInUp">
                    <div class="about-us-image">
                        <figure class="image-anime">
                            <img src="{{ $aboutWhoMain ? asset('uploads/'.$aboutWhoMain) : asset('images/our-approach-image-1.jpg') }}" alt="i3 Realtors Team" />
                        </figure>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="about-us-content-box wow fadeInUp" data-wow-delay="0.2s">
                    <div class="about-us-item-list">
                        <div class="about-us-item box-1">
                            <div class="about-us-item-content">
                                <h3>Founded on Expertise</h3>
                                <p>With a combined 40+ years of real estate experience, our founding team brings deep market insight, strong developer relationships, and a results-driven approach to every mandate.</p>
                            </div>
                            <div class="about-us-item-image">
                                <figure>
                                    <img src="{{ $aboutWhoBox1 ? asset('uploads/'.$aboutWhoBox1) : asset('images/our-history-image-1.png') }}" alt="" />
                                </figure>
                            </div>
                        </div>

                        <div class="about-us-item box-2">
                            <div class="about-us-item-content">
                                <h3>Driven by Results</h3>
                                <p>From project launch to final sale, we measure our success by the results we deliver — faster sales velocity, stronger investor connect, and long-term developer partnerships.</p>
                            </div>
                            <div class="about-us-item-image">
                                <figure class="image-anime">
                                    <img src="{{ $aboutWhoBox2 ? asset('uploads/'.$aboutWhoBox2) : asset('images/our-approach-image-2.jpg') }}" alt="" />
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
                <div class="wow fadeInUp" data-wow-delay="{{ ['','0.2s','0.4s'][$i] ?? '' }}"
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
<div style="padding: 90px 0 100px; background: #f8f7f4; position:relative; overflow:hidden;">

    <div class="container-fluid px-4 px-lg-5">
        <div class="row section-row">
            <div class="col-lg-12">
                <div class="section-title section-title-center">
                    <span class="section-sub-title wow fadeInUp">Our Track Record</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">Achievements</h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s" style="color:#666; max-width:580px; margin:0 auto; font-size:15px; line-height:1.8;">
                        A testament to our execution — projects sold, trust earned, and numbers that speak for themselves.
                    </p>
                </div>
            </div>
        </div>

        @if(isset($achievements) && $achievements->isNotEmpty())
        <div class="wow fadeInUp" data-wow-delay="0.2s" style="position:relative; margin-top:28px;">

            {{-- Nav buttons --}}
            <button id="achPrev" onclick="scrollAch(-1)"
                    style="position:absolute; left:-6px; top:45%; transform:translateY(-50%); z-index:10; width:48px; height:48px; border-radius:50%; background:var(--accent-secondary-color); border:none; color:#fff; font-size:15px; cursor:pointer; box-shadow:0 4px 24px rgba(224,90,0,0.45); transition:all 0.25s;">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button id="achNext" onclick="scrollAch(1)"
                    style="position:absolute; right:-6px; top:45%; transform:translateY(-50%); z-index:10; width:48px; height:48px; border-radius:50%; background:var(--accent-secondary-color); border:none; color:#fff; font-size:15px; cursor:pointer; box-shadow:0 4px 24px rgba(224,90,0,0.45); transition:all 0.25s;">
                <i class="fas fa-chevron-right"></i>
            </button>

            <div id="achTrack" style="display:flex; gap:22px; overflow:hidden; scroll-behavior:smooth; padding:8px 6px 28px;">
                @foreach($achievements as $achievement)
                <div class="ach-slide" style="flex:0 0 calc(25% - 17px); min-width:240px;">
                    <div class="ach-card" style="background:#ffffff; border-radius:18px; overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,0.07); transition:transform 0.3s ease, box-shadow 0.3s ease; height:100%; display:flex; flex-direction:column;">

                        {{-- Orange accent strip --}}
                        <div style="height:4px; background:linear-gradient(90deg, var(--accent-secondary-color) 0%, #ff8c42 100%); flex-shrink:0;"></div>

                        {{-- Dark header: developer name + location --}}
                        <div style="background:linear-gradient(135deg, #181818 0%, #2a2a2a 100%); padding:22px 20px 18px; text-align:center; flex-shrink:0;">
                            <h3 style="color:#fff; font-size:14px; font-weight:800; letter-spacing:1.8px; margin:0 0 6px; text-transform:uppercase; line-height:1.4;">{{ $achievement->title }}</h3>
                            @if($achievement->location)
                            <span style="display:inline-flex; align-items:center; gap:5px; background:rgba(224,90,0,0.15); color:var(--accent-secondary-color); font-size:11px; font-weight:600; padding:3px 10px; border-radius:20px; letter-spacing:0.4px;">
                                <i class="fas fa-map-marker-alt" style="font-size:9px;"></i>{{ $achievement->location }}
                            </span>
                            @endif
                        </div>

                        {{-- Logo --}}
                        <div style="padding:22px 20px 16px; text-align:center; background:#fff; min-height:100px; display:flex; align-items:center; justify-content:center; border-bottom:1px solid #f2f2f2; flex-shrink:0;">
                            @if($achievement->image)
                                <img src="{{ asset('uploads/' . $achievement->image) }}" alt="{{ $achievement->title }}"
                                     style="max-height:68px; max-width:150px; object-fit:contain;">
                            @else
                                <div style="width:60px; height:60px; background:linear-gradient(135deg,#f5f5f5,#ebebeb); border-radius:12px; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-building" style="font-size:22px; color:#ccc;"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Stats --}}
                        <div style="padding:16px 18px 20px; flex:1;">
                            @if($achievement->units)
                            <div style="display:flex; align-items:center; gap:12px; padding:9px 0; border-bottom:1px solid #f5f5f5;">
                                <div style="width:34px; height:34px; background:rgba(224,90,0,0.10); border-radius:9px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                    <i class="fas fa-building-user" style="font-size:13px; color:var(--accent-secondary-color);"></i>
                                </div>
                                <div style="min-width:0;">
                                    <div style="font-size:10px; color:#aaa; text-transform:uppercase; letter-spacing:0.6px; line-height:1; margin-bottom:3px;">No. of Units</div>
                                    <div style="font-size:16px; font-weight:800; color:#111; line-height:1.2;">{{ $achievement->units }}</div>
                                </div>
                            </div>
                            @endif
                            @if($achievement->sales_value)
                            <div style="display:flex; align-items:center; gap:12px; padding:9px 0; border-bottom:1px solid #f5f5f5;">
                                <div style="width:34px; height:34px; background:rgba(224,90,0,0.10); border-radius:9px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                    <i class="fas fa-chart-line" style="font-size:13px; color:var(--accent-secondary-color);"></i>
                                </div>
                                <div style="min-width:0;">
                                    <div style="font-size:10px; color:#aaa; text-transform:uppercase; letter-spacing:0.6px; line-height:1; margin-bottom:3px;">Sales Value</div>
                                    <div style="font-size:16px; font-weight:800; color:#111; line-height:1.2;">{{ $achievement->sales_value }}</div>
                                </div>
                            </div>
                            @endif
                            @if($achievement->sold_percentage)
                            <div style="display:flex; align-items:center; gap:12px; padding:9px 0; border-bottom:1px solid #f5f5f5;">
                                <div style="width:34px; height:34px; background:rgba(224,90,0,0.10); border-radius:9px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                    <i class="fas fa-circle-check" style="font-size:13px; color:var(--accent-secondary-color);"></i>
                                </div>
                                <div style="min-width:0;">
                                    <div style="font-size:10px; color:#aaa; text-transform:uppercase; letter-spacing:0.6px; line-height:1; margin-bottom:3px;">Sold</div>
                                    <div style="font-size:16px; font-weight:800; color:#111; line-height:1.2;">{{ $achievement->sold_percentage }}</div>
                                </div>
                            </div>
                            @endif
                            @if($achievement->time_period)
                            <div style="display:flex; align-items:center; gap:12px; padding:9px 0;">
                                <div style="width:34px; height:34px; background:rgba(224,90,0,0.10); border-radius:9px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                    <i class="fas fa-clock" style="font-size:13px; color:var(--accent-secondary-color);"></i>
                                </div>
                                <div style="min-width:0;">
                                    <div style="font-size:10px; color:#aaa; text-transform:uppercase; letter-spacing:0.6px; line-height:1; margin-bottom:3px;">Duration</div>
                                    <div style="font-size:16px; font-weight:800; color:#111; line-height:1.2;">{{ $achievement->time_period }}</div>
                                </div>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
                @endforeach
            </div>

            {{-- Dot indicators --}}
            <div id="achDots" style="display:flex; justify-content:center; gap:8px; margin-top:8px;"></div>
        </div>
        @else
        <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.2s">
            <div class="col-lg-6 text-center">
                <p style="color:#aaa; font-size:15px;">Achievements coming soon.</p>
            </div>
        </div>
        @endif

        {{-- Gallery Slider inside Achievements --}}
        @if(isset($achievementGallery) && $achievementGallery->isNotEmpty())
        <div style="margin-top:60px; position:relative;" class="wow fadeInUp" data-wow-delay="0.2s">
            <div style="text-align:center; margin-bottom:32px;">
                <span style="font-size:11px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:var(--accent-secondary-color);">Gallery</span>
                <h3 style="font-size:24px; font-weight:800; color:#111; margin:8px 0 0;">Our Projects in Action</h3>
            </div>
            <button id="agPrev" onclick="agScroll(-1)"
                style="position:absolute; left:0; top:50%; transform:translateY(-50%); z-index:10; width:44px; height:44px; border-radius:50%; background:var(--accent-secondary-color); border:none; color:#fff; font-size:14px; cursor:pointer; box-shadow:0 4px 16px rgba(224,90,0,0.35);">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button id="agNext" onclick="agScroll(1)"
                style="position:absolute; right:0; top:50%; transform:translateY(-50%); z-index:10; width:44px; height:44px; border-radius:50%; background:var(--accent-secondary-color); border:none; color:#fff; font-size:14px; cursor:pointer; box-shadow:0 4px 16px rgba(224,90,0,0.35);">
                <i class="fas fa-chevron-right"></i>
            </button>
            <div id="agTrack" style="display:flex; gap:16px; overflow:hidden; scroll-behavior:smooth; padding:4px 56px 8px;">
                @foreach($achievementGallery as $img)
                <div class="ag-slide" style="flex:0 0 calc(25% - 12px); min-width:200px;">
                    <div style="border-radius:12px; overflow:hidden; aspect-ratio:1/1; position:relative;"
                         onmouseover="this.querySelector('img').style.transform='scale(1.06)'"
                         onmouseout="this.querySelector('img').style.transform='scale(1)'">
                        <img src="{{ asset('uploads/' . $img->image_path) }}"
                             alt="{{ $img->caption ?? '' }}"
                             style="width:100%; height:100%; object-fit:cover; transition:transform 0.45s ease;">
                        @if($img->caption)
                        <div style="position:absolute; bottom:0; left:0; right:0; padding:12px 14px; background:linear-gradient(transparent,rgba(0,0,0,0.6));">
                            <p style="margin:0; color:#fff; font-size:12px; font-weight:600;">{{ $img->caption }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            <div id="agDots" style="display:flex; justify-content:center; gap:8px; margin-top:24px;"></div>
        </div>
        @endif

    </div>
</div>
<!-- Achievements Section End -->

@push('scripts')
<script>
(function () {
    var track = document.getElementById('achTrack');
    if (!track) return;

    var visibleCount = 4;
    var totalCards   = track.querySelectorAll('.ach-slide').length;
    var dotsEl       = document.getElementById('achDots');
    var currentPage  = 0;

    function getCardWidth() {
        var first = track.firstElementChild;
        return first ? first.offsetWidth + 22 : 262;
    }

    function totalPages() {
        return Math.ceil(totalCards / visibleCount);
    }

    function updateDots() {
        if (!dotsEl) return;
        var pages = totalPages();
        if (pages <= 1) { dotsEl.style.display = 'none'; return; }
        dotsEl.innerHTML = '';
        for (var i = 0; i < pages; i++) {
            var d = document.createElement('button');
            d.style.cssText = 'width:' + (i === currentPage ? '28px' : '8px') + '; height:8px; border-radius:4px; border:none; cursor:pointer; transition:all 0.3s; background:' + (i === currentPage ? 'var(--accent-secondary-color)' : 'rgba(255,255,255,0.3)') + ';';
            (function(page){ d.addEventListener('click', function(){ goToPage(page); }); })(i);
            dotsEl.appendChild(d);
        }
    }

    function goToPage(page) {
        currentPage = Math.max(0, Math.min(page, totalPages() - 1));
        var cw = getCardWidth();
        track.scrollLeft = currentPage * cw * visibleCount;
        updateDots();
    }

    window.scrollAch = function (dir) {
        goToPage(currentPage + dir);
    };

    // Hover lift effect
    track.querySelectorAll('.ach-card').forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-6px)';
            this.style.boxShadow = '0 8px 28px rgba(0,0,0,0.13)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 4px 16px rgba(0,0,0,0.07)';
        });
    });

    updateDots();
})();

// Achievement gallery slider
(function(){
    var track = document.getElementById('agTrack');
    if (!track) return;
    var slides = track.querySelectorAll('.ag-slide');
    var dotsEl = document.getElementById('agDots');
    var total  = slides.length;
    var perView = window.innerWidth < 576 ? 1 : window.innerWidth < 992 ? 2 : window.innerWidth < 1400 ? 3 : 4;
    var current = 0;
    var autoTimer;

    function cardW() { return slides[0] ? slides[0].offsetWidth + 16 : 216; }
    function pages() { return Math.max(1, Math.ceil(total / perView)); }

    function buildDots() {
        if (!dotsEl) return;
        dotsEl.innerHTML = '';
        var p = pages();
        if (p <= 1) return;
        for (var i = 0; i < p; i++) {
            var d = document.createElement('button');
            d.style.cssText = 'width:'+(i===current?'24px':'8px')+';height:8px;border-radius:4px;border:none;cursor:pointer;transition:all 0.3s;background:'+(i===current?'var(--accent-secondary-color)':'#ccc')+';padding:0;';
            (function(idx){ d.addEventListener('click', function(){ goTo(idx); reset(); }); })(i);
            dotsEl.appendChild(d);
        }
    }

    function goTo(page) {
        current = Math.max(0, Math.min(page, pages() - 1));
        track.scrollLeft = current * cardW() * perView;
        buildDots();
    }

    function reset() {
        clearInterval(autoTimer);
        autoTimer = setInterval(function(){ goTo((current + 1) % pages()); }, 3500);
    }

    window.agScroll = function(dir) { goTo(current + dir); reset(); };
    buildDots();
    reset();

    window.addEventListener('resize', function(){
        perView = window.innerWidth < 576 ? 1 : window.innerWidth < 992 ? 2 : window.innerWidth < 1400 ? 3 : 4;
        goTo(0);
    });
})();
</script>
@endpush

@if(isset($galleryImages) && $galleryImages->isNotEmpty())
<!-- Life at i3 Realtors Section Start -->
<div style="padding: 90px 0 100px; background: #fff;">
    <div class="container-fluid px-4 px-lg-5">

        <div class="section-title section-title-center wow fadeInUp" style="margin-bottom:48px;">
            <span class="section-sub-title">Our Team</span>
            <h2 class="text-anime-style-2" data-cursor="-opaque">Life at <span>i3 Realtors</span></h2>
        </div>

        <div style="position:relative;" class="wow fadeInUp" data-wow-delay="0.15s">
            <button onclick="lifeScroll(-1)"
                style="position:absolute; left:0; top:40%; transform:translateY(-50%); z-index:10; width:48px; height:48px; border-radius:50%; background:var(--accent-secondary-color); border:none; color:#fff; font-size:15px; cursor:pointer; box-shadow:0 4px 20px rgba(224,90,0,0.4);">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button onclick="lifeScroll(1)"
                style="position:absolute; right:0; top:40%; transform:translateY(-50%); z-index:10; width:48px; height:48px; border-radius:50%; background:var(--accent-secondary-color); border:none; color:#fff; font-size:15px; cursor:pointer; box-shadow:0 4px 20px rgba(224,90,0,0.4);">
                <i class="fas fa-chevron-right"></i>
            </button>

            <div id="lifeTrack" style="display:flex; gap:16px; overflow:hidden; scroll-behavior:smooth; padding:4px 60px 8px;">
                @foreach($galleryImages as $image)
                <div class="life-slide" style="flex:0 0 calc(33.333% - 11px); min-width:240px;">
                    <div style="border-radius:14px; overflow:hidden; aspect-ratio:1/1; position:relative;"
                         onmouseover="this.querySelector('img').style.transform='scale(1.06)'"
                         onmouseout="this.querySelector('img').style.transform='scale(1)'">
                        <img src="{{ asset('uploads/' . $image->image_path) }}"
                             alt="{{ $image->caption ?? 'i3 Realtors' }}"
                             style="width:100%; height:100%; object-fit:cover; transition:transform 0.5s ease;">
                        @if($image->caption)
                        <div style="position:absolute; bottom:0; left:0; right:0; padding:14px 16px; background:linear-gradient(transparent,rgba(0,0,0,0.65));">
                            <p style="margin:0; color:#fff; font-size:13px; font-weight:600;">{{ $image->caption }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <div id="lifeDots" style="display:flex; justify-content:center; gap:8px; margin-top:28px;"></div>
        </div>
    </div>
</div>
<!-- Life at i3 Realtors Section End -->

@push('scripts')
<script>
(function(){
    var track = document.getElementById('lifeTrack');
    if (!track) return;
    var slides = track.querySelectorAll('.life-slide');
    var dotsEl = document.getElementById('lifeDots');
    var total  = slides.length;
    var perView = window.innerWidth < 768 ? 1 : window.innerWidth < 1024 ? 2 : 3;
    var current = 0;
    var timer;

    function cw() { return slides[0] ? slides[0].offsetWidth + 16 : 256; }
    function pages() { return Math.max(1, Math.ceil(total / perView)); }

    function buildDots() {
        if (!dotsEl) return;
        dotsEl.innerHTML = '';
        var p = pages(); if (p <= 1) return;
        for (var i = 0; i < p; i++) {
            var d = document.createElement('button');
            d.style.cssText = 'width:'+(i===current?'28px':'8px')+';height:8px;border-radius:4px;border:none;cursor:pointer;transition:all 0.3s;background:'+(i===current?'var(--accent-secondary-color)':'#ddd')+';padding:0;';
            (function(idx){ d.addEventListener('click', function(){ go(idx); reset(); }); })(i);
            dotsEl.appendChild(d);
        }
    }

    function go(page) {
        current = Math.max(0, Math.min(page, pages()-1));
        track.scrollLeft = current * cw() * perView;
        buildDots();
    }

    function reset() {
        clearInterval(timer);
        timer = setInterval(function(){ go((current+1) % pages()); }, 3500);
    }

    window.lifeScroll = function(dir) { go(current + dir); reset(); };
    buildDots();
    reset();
    window.addEventListener('resize', function(){
        perView = window.innerWidth < 768 ? 1 : window.innerWidth < 1024 ? 2 : 3;
        go(0);
    });
})();
</script>
@endpush
@endif

<!-- Our Approach Section Start -->
<div class="our-approach bg-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6">
                @php
                    $aboutApproach1 = \App\Models\Setting::get('about_approach_image_1');
                    $aboutApproach2 = \App\Models\Setting::get('about_approach_image_2');
                @endphp
                <!-- Our Approach Images Start -->
                <div class="our-approach-images">
                    <!-- Our Approach Image Box-1 Start -->
                    <div class="our-approach-image-box-1">
                        <!-- Our Approach Image Start -->
                        <div class="our-approach-image">
                            <figure class="image-anime reveal">
                                <img src="{{ $aboutApproach1 ? asset('uploads/'.$aboutApproach1) : asset('images/our-approach-image-1.jpg') }}" alt="">
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
                                <img src="{{ $aboutApproach2 ? asset('uploads/'.$aboutApproach2) : asset('images/our-approach-image-2.jpg') }}" alt="">
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
                        <div class="history-item-image" style="align-content:unset; margin: 0 -40px -40px;">
                            <figure style="width:100%; max-width:100%; margin:0; border-radius:0 0 20px 20px; overflow:hidden; height:220px;">
                                @php $j1 = \App\Models\Setting::get('about_journey_image_1'); @endphp
                                <img src="{{ $j1 ? asset('uploads/'.$j1) : asset('images/our-history-image-1.png') }}" alt=""
                                     style="width:100%; height:100%; object-fit:cover; object-position:center; border-radius:0;">
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
                        <div class="history-item-image" style="align-content:unset; margin: 0 -40px -40px;">
                            <figure style="width:100%; max-width:100%; margin:0; border-radius:0 0 20px 20px; overflow:hidden; height:220px;">
                                @php $j2 = \App\Models\Setting::get('about_journey_image_2'); @endphp
                                <img src="{{ $j2 ? asset('uploads/'.$j2) : asset('images/our-history-image-2.png') }}" alt=""
                                     style="width:100%; height:100%; object-fit:cover; object-position:center; border-radius:0;">
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
                        <div class="history-item-image" style="align-content:unset; margin: 0 -40px -40px;">
                            <figure style="width:100%; max-width:100%; margin:0; border-radius:0 0 20px 20px; overflow:hidden; height:220px;">
                                @php $j3 = \App\Models\Setting::get('about_journey_image_3'); @endphp
                                <img src="{{ $j3 ? asset('uploads/'.$j3) : asset('images/our-history-image-3.png') }}" alt=""
                                     style="width:100%; height:100%; object-fit:cover; object-position:center; border-radius:0;">
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
                        <div class="history-item-image" style="align-content:unset; margin: 0 -40px -40px;">
                            <figure style="width:100%; max-width:100%; margin:0; border-radius:0 0 20px 20px; overflow:hidden; height:220px;">
                                @php $j4 = \App\Models\Setting::get('about_journey_image_4'); @endphp
                                <img src="{{ $j4 ? asset('uploads/'.$j4) : asset('images/our-history-image-1.png') }}" alt=""
                                     style="width:100%; height:100%; object-fit:cover; object-position:center; border-radius:0;">
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
<div class="cta-box bg-section dark-section parallaxie" @if(!empty($site['cta_bg_image'])) style="background-image:url('{{ asset('uploads/'.$site['cta_bg_image']) }}');" @endif>
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
                    <a href="{{ route('website.projects.index') }}" class="btn-default btn-highlighted">Explore Opportunities</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CTA Box Section End -->

@endsection
