@extends('layouts.website')

@section('title', $site['meta_title'] ?? 'i3Realtors - Smart Real Estate & Reliable Construction')
@section('meta_description', $site['meta_description'] ?? '')

@section('content')

    <!-- Hero Section Start -->
    @php $hasVideo = ($heroSettings['video_type'] === 'youtube' && $heroSettings['video_url']) || ($heroSettings['video_type'] === 'upload' && $heroSettings['video_file']); @endphp
    <div class="hero hero-video bg-section {{ $hasVideo ? '' : 'dark-section' }}" style="position:relative; overflow:hidden; {{ $hasVideo ? 'background-image:none;' : '' }}">

      {{-- Fluid animation canvas removed from hero; lives in Trusted Developers section --}}

      {{-- Hero background video --}}
      @if($heroSettings['video_type'] === 'youtube' && $heroSettings['video_url'])
      @php
        // Broad regex: matches /watch?v=, youtu.be/, /embed/, /shorts/
        preg_match('/(?:youtube\.com\/(?:watch\?(?:.*&)?v=|embed\/|shorts\/|v\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $heroSettings['video_url'], $m);
        $ytId    = $m[1] ?? '';
        $ytStart = (int) $heroSettings['video_start'];
        $ytEnd   = (int) $heroSettings['video_end'];
      @endphp
      @if($ytId)
      {{-- Wrapper covers full hero; z-index:2 puts it above .hero::before (z-index:1) --}}
      <div style="position:absolute;inset:0;overflow:hidden;z-index:2;pointer-events:none;">
        <div id="yt-hero-player"
             data-vid="{{ $ytId }}"
             data-start="{{ $ytStart }}"
             data-end="{{ $ytEnd }}"></div>
      </div>
      <div style="position:absolute;inset:0;background:rgba(0,0,0,0.5);z-index:3;pointer-events:none;"></div>
      @push('scripts')
      <script>
      (function(){
        var el = document.getElementById('yt-hero-player');
        if (!el) return;
        var _ytId    = el.getAttribute('data-vid');
        var _ytStart = parseInt(el.getAttribute('data-start')) || 0;
        var _ytEnd   = parseInt(el.getAttribute('data-end'))   || 0;
        var _ytHeroPlayer;

        function _initHeroYT() {
          _ytHeroPlayer = new YT.Player('yt-hero-player', {
            videoId: _ytId,
            playerVars: {
              autoplay: 1, mute: 1, controls: 0, rel: 0,
              showinfo: 0, modestbranding: 1, playsinline: 1,
              loop: 1, playlist: _ytId,
              start: _ytStart,
            },
            events: {
              onReady: function(e) {
                var iframe = e.target.getIframe();
                iframe.style.cssText = 'position:absolute;top:50%;left:50%;width:177.78vh;min-width:100%;height:56.25vw;min-height:100%;transform:translate(-50%,-50%);border:0;pointer-events:none;';
                e.target.playVideo();
              },
              onStateChange: function(e) {
                if (e.data === YT.PlayerState.PLAYING && _ytEnd > 0) {
                  clearInterval(window._ytHeroTimer);
                  window._ytHeroTimer = setInterval(function() {
                    if (_ytHeroPlayer && _ytHeroPlayer.getCurrentTime() >= _ytEnd) {
                      _ytHeroPlayer.seekTo(_ytStart, true);
                    }
                  }, 500);
                }
                if (e.data === YT.PlayerState.ENDED) {
                  _ytHeroPlayer.seekTo(_ytStart, true);
                  _ytHeroPlayer.playVideo();
                }
              }
            }
          });
        }

        // Chain with jquery.mb.YTPlayer's onYouTubeIframeAPIReady (it overwrites the global)
        var _prevReady = window.onYouTubeIframeAPIReady;
        window.onYouTubeIframeAPIReady = function() {
          if (typeof _prevReady === 'function') _prevReady();
          _initHeroYT();
        };

        // Load YouTube IFrame API (mb.YTPlayer may already have queued it)
        if (!document.getElementById('yt-api-script')) {
          var tag = document.createElement('script');
          tag.id  = 'yt-api-script';
          tag.src = 'https://www.youtube.com/iframe_api';
          document.head.appendChild(tag);
        } else if (window.YT && window.YT.Player) {
          _initHeroYT();
        }
      })();
      </script>
      @endpush
      @endif
      @elseif($heroSettings['video_type'] === 'upload' && $heroSettings['video_file'])
      @php
        $videoPath = $heroSettings['video_file'];
        $ext = strtolower(pathinfo($videoPath, PATHINFO_EXTENSION));
        $mime = $ext === 'webm' ? 'video/webm' : 'video/mp4';
      @endphp
      <video autoplay muted loop playsinline
             style="position:absolute;top:50%;left:50%;width:100%;height:100%;object-fit:cover;transform:translate(-50%,-50%);z-index:2;">
        <source src="{{ asset('uploads/' . $videoPath) }}" type="{{ $mime }}">
      </video>
      <div style="position:absolute;inset:0;background:rgba(0,0,0,0.5);z-index:3;"></div>
      @endif

      <div class="container" style="position:relative; z-index:4;">
        <div class="row justify-content-center">
          <div class="col-xl-8 col-lg-10 text-center">

            <!-- Heading -->
            <div class="hero-content-box">
              <div class="section-title section-title-center">
                <h1 class="text-anime-style-2" data-cursor="-opaque" style="font-size:clamp(2rem,4vw,3.2rem); color:#ffffff;">
                  Strategic Booster For Developers and Investors
                </h1>
              </div>
            </div>

            <!-- Counters -->
            <div class="hero-counter-box wow fadeInUp" data-wow-delay="0.1s" style="display:flex; flex-wrap:nowrap; gap:0; margin-top:36px; width:100%; justify-content:center;">
              <div class="hero-counter-item" style="text-align:center; flex:1; padding: 0 16px">
                <h2><span class="counter">20</span>+</h2>
                <p>Developer Partnerships</p>
              </div>
              <div class="hero-counter-item" style="text-align:center; flex:1; padding: 0 16px">
                <h2><span class="counter">36</span>+</h2>
                <p>Projects Handled</p>
              </div>
              <div class="hero-counter-item" style="text-align:center; flex:1; padding: 0 16px">
                <h2><span class="counter">450</span>+</h2>
                <p>Investor Network</p>
              </div>
              <div class="hero-counter-item" style="text-align:center; flex:1; padding: 0 16px;">
                <h2><span class="counter">1800</span>+</h2>
                <p>Channel Partner Network</p>
              </div>
            </div>

            <!-- Rating sentence only -->
            <div class="wow fadeInUp" data-wow-delay="0.2s" style="margin-top:24px;">
              <p style="color: rgba(255,255,255,0.7); font-size: 14px; margin:0;">Trusted by Developers &amp; Investment Partners &nbsp;|&nbsp; 4.9 Client Satisfaction Rating</p>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- Hero Section End -->

    <!-- Trusted Developers Section Start -->
    <div class="bg-section" style="background: #faf7f0; padding: 100px 0; border-top: 1px solid rgba(200,169,106,0.2); border-bottom: 1px solid rgba(200,169,106,0.2); position:relative; overflow:hidden; margin: 12px auto;">
      <div class="container" style="position:relative; z-index:1;">
        <div class="row section-row">
          <div class="col-lg-12">
            <div class="section-title section-title-center">
              <span class="section-sub-title wow fadeInUp">Our Developer Partners</span>
              <h2 class="text-anime-style-2" data-cursor="-opaque">
                Trusted by Leading <span>Developers</span>
              </h2>
              <p class="wow fadeInUp" data-wow-delay="0.2s" style="color:#666; max-width:680px; margin: 0 auto 16px;">
                We have partnered with leading real estate developers across Pune and Mumbai to deliver structured mandate sales, marketing strategies, and investor-driven growth.
              </p>
            </div>
          </div>
        </div>

        @if($developerLogos->isNotEmpty())
        <div class="wow fadeInUp" data-wow-delay="0.4s" style="overflow: hidden; position: relative;">
          <div class="developer-logo-track" style="display: flex; gap: 24px; align-items: center; animation: logoScroll 30s linear infinite;">
            @foreach($developerLogos->concat($developerLogos) as $devLogo)
            <div class="developer-logo-item" style="flex-shrink: 0;">
              @if($devLogo->link)
              <a href="{{ $devLogo->link }}" target="_blank" rel="noopener noreferrer" style="text-decoration:none;">
              @endif
              <div style="
                display: flex; align-items: center; gap: 12px;
                padding: 10px 20px;
                background: #ffffff;
                border: 1px solid rgba(200,169,106,0.25);
                border-radius: 50px;
                box-shadow: 0 2px 12px rgba(0,0,0,0.06);
                transition: all 0.3s ease;
                white-space: nowrap;
              "
              onmouseover="this.style.boxShadow='0 4px 20px rgba(184,150,43,0.2)'; this.style.borderColor='rgba(200,169,106,0.6)';"
              onmouseout="this.style.boxShadow='0 2px 12px rgba(0,0,0,0.06)'; this.style.borderColor='rgba(200,169,106,0.25)';">
                <img src="{{ asset('uploads/' . $devLogo->logo) }}" alt="{{ $devLogo->name }}"
                     style="height: auto; width: 200px; max-width: 200px; object-fit: contain;">
              </div>
              @if($devLogo->link)
              </a>
              @endif
            </div>
            @endforeach
          </div>
        </div>
        @else
        <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.4s">
          <div class="col-lg-10">
            <div style="display: flex; flex-wrap: wrap; gap: 24px; justify-content: center; align-items: center; padding: 20px 0;">
              @foreach(['Shapoorji Pallonji', 'Puranik Builders', 'Gagan Developers', 'Kumar Properties', 'Kolte Patil', 'Mantra'] as $devName)
              <div style="padding: 12px 24px; background: #ffffff; border: 1px solid rgba(200,169,106,0.3); border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                <span style="color: #555; font-size: 13px; font-weight: 600; letter-spacing: 0.5px;">{{ $devName }}</span>
              </div>
              @endforeach
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
    <!-- Trusted Developers Section End -->

    <!-- About US Section Start -->
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
    <!-- About US Section End -->

    <!-- Our Service Section Start -->
    <div class="our-service bg-section" style="margin: 12px auto;">
      <div class="container">
        <div class="row section-row">
          <div class="col-lg-12">
            <div class="section-title section-title-center">
              <span class="section-sub-title wow fadeInUp">Our Services</span>
              <h2 class="text-anime-style-2" data-cursor="-opaque">
                I3 Realtors <span>Services</span>
              </h2>
            </div>
          </div>
        </div>

        <div class="row service-item-list g-4 justify-content-center">
          @php
          $services = [
            ['img' => 'service-1.jpg', 'icon' => 'fa-house-chimney',     'title' => 'Residential',         'desc' => 'End-to-end mandate management for residential projects — from launch positioning to sales execution and investor connect.', 'delay' => ''],
            ['img' => 'service-2.jpg', 'icon' => 'fa-building',          'title' => 'Commercial',          'desc' => 'Commercial property sales advisory and mandate representation to maximise developer returns and buyer engagement.', 'delay' => '0.1s'],
            ['img' => 'service-3.jpg', 'icon' => 'fa-store',             'title' => 'Retail',              'desc' => 'Retail space leasing, tenant mix strategy, and mandate services tailored to high-footfall commercial developments.', 'delay' => '0.2s'],
            ['img' => 'service-4.jpg', 'icon' => 'fa-chart-line',        'title' => 'Investment Banking',  'desc' => 'Structured real estate investment solutions, deal syndication, and financial advisory for large-scale developments.', 'delay' => '0.1s'],
            ['img' => 'service-1.jpg', 'icon' => 'fa-file-signature',    'title' => 'Commercial Leasing',  'desc' => 'Strategic leasing mandates for office spaces, warehouses, and retail units — negotiated for optimal occupancy and yield.', 'delay' => '0.2s'],
            ['img' => 'service-2.jpg', 'icon' => 'fa-concierge-bell',    'title' => 'Hospitality',         'desc' => 'Hospitality real estate consulting, hotel project mandates, and investment advisory for premium leisure developments.', 'delay' => '0.3s'],
            ['img' => 'service-3.jpg', 'icon' => 'fa-diagram-project',   'title' => 'Project Management',  'desc' => 'Complete project oversight from planning to delivery — coordinating timelines, resources, and stakeholder communication.', 'delay' => '0.2s'],
            ['img' => 'service-4.jpg', 'icon' => 'fa-compass-drafting',  'title' => 'Designing',           'desc' => 'Architectural design consultation and interior planning to elevate project appeal and buyer experience.', 'delay' => '0.4s'],
            ['img' => 'service-2.jpg', 'icon' => 'fa-bullhorn',          'title' => 'Branding',            'desc' => 'Developer and project branding, identity creation, and marketing collateral to build lasting market presence.', 'delay' => '0.3s'],
            ['img' => 'service-3.jpg', 'icon' => 'fa-hand-holding-dollar', 'title' => 'Fund Raising',      'desc' => 'Real estate fund structuring, investor outreach, and capital raising services for developers and project promoters.', 'delay' => '0.4s', 'link' => route('services.fund-raising')],
          ];
          @endphp

          @foreach($services as $i => $svc)
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="service-item {{ $i === 0 ? 'active' : '' }} wow fadeInUp" {{ $svc['delay'] ? 'data-wow-delay="'.$svc['delay'].'"' : '' }}>
              <div class="service-item-image">
                <figure>
                  <img src="{{ asset('images/'.$svc['img']) }}" alt="{{ $svc['title'] }}" />
                </figure>
              </div>
              <div class="service-item-body">
                <div class="icon-box" style="display:flex; align-items:center; justify-content:center;">
                  <i class="fa-solid {{ $svc['icon'] }}" style="font-size:28px; color: var(--accent-secondary-color);"></i>
                </div>
                <div class="service-item-body-content">
                  <div class="service-item-content">
                    <h2>{{ $svc['title'] }}</h2>
                    <p>{{ $svc['desc'] }}</p>
                  </div>
                  <div class="service-item-btn">
                    @if(!empty($svc['link']))
                      <a href="{{ $svc['link'] }}" class="readmore-btn">View Details</a>
                    @else
                      <span class="readmore-btn">View Details</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach

          <div class="col-lg-12">
            <div class="section-footer-text section-satisfy-img wow fadeInUp" data-wow-delay="0.4s">
              <div class="satisfy-client-images">
                <div class="satisfy-client-image">
                  <figure class="image-anime">
                    <img src="{{ asset('images/author-1.jpg') }}" alt="" />
                  </figure>
                </div>
                <div class="satisfy-client-image add-more">
                  <img src="{{ asset('images/icon-phone-primary.svg') }}" alt="" />
                </div>
              </div>
              <p>Strategic Real Estate Consulting & Developer Partnerships</p>
              <p>Trusted by Developers & Investors Across Pune</p>
              <ul>
                <li>
                  <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </li>
                <li>4.9 / 5 Client Satisfaction Rating</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Our Service Section End -->

    <!-- Who We Are Section Start -->
    <div class="who-we-are bg-section" style="padding: 90px 0; background: #f8f8f6;">
      @php
      $whyTabs = [
        ['id'=>'wt1','num'=>'01','icon'=>'fa-map',          'label'=>'Strategic Roadmap',      'title'=>'Strategic Roadmap',           'desc'=>'We create a clear strategic roadmap aligned with market conditions to accelerate project sales and developer success.', 'points'=>['Way Forward Strategies','Sales Velocity Actions','Pricing Strategies','Branding & Market Communication']],
        ['id'=>'wt2','num'=>'02','icon'=>'fa-bolt',          'label'=>'High Velocity Sales',    'title'=>'High Velocity of Sales',      'desc'=>'We deploy high-velocity sales mechanisms to drive consistent deal closures across developer projects.',                 'points'=>['360 Degree Marketing','CP Network Extend','NRI Outreach','Direct Investor Connect']],
        ['id'=>'wt3','num'=>'03','icon'=>'fa-handshake',     'label'=>'Sales Expertise',        'title'=>'Sales Expertise',             'desc'=>'Our experienced sales team provides on-ground support to convert leads into successful property transactions.',           'points'=>['Trained Sales Specialists','Dedicated Support Center','Site Visit Coordination','Closure Management']],
        ['id'=>'wt4','num'=>'04','icon'=>'fa-chart-bar',     'label'=>'Performance Base',       'title'=>'Performance Base – CP Network','desc'=>'Our channel partner network is built on performance, ensuring active and motivated partners drive consistent sales.',       'points'=>['Channel Partner Onboarding','CP Training & Enablement','Incentive Structures','Network Expansion']],
        ['id'=>'wt5','num'=>'05','icon'=>'fa-people-group',  'label'=>'Our Sales Force',        'title'=>'Our Sales Force',             'desc'=>'Our dedicated sales force combines domain expertise and performance marketing to drive qualified leads and successful closures.','points'=>['Trained Sales Professionals','Developer Relationship Managers','Investor Advisory Team','Field Sales Execution','Lead Generation Funnels','Analytics & Reporting']],
        ['id'=>'wt6','num'=>'06','icon'=>'fa-gears',         'label'=>'Process Excellence',     'title'=>'Process Excellence',          'desc'=>'We follow structured processes and systems that ensure consistency, transparency, and efficiency across all mandate engagements.','points'=>['Structured Sales Process','CRM & Reporting Systems','Quality Assurance','Post-Sale Support']],
      ];
      @endphp

      <style>
        .why-section-wrap { max-width:1200px; margin:0 auto; padding:0 20px; }
        .why-section-head { text-align:center; margin-bottom:56px; }
        .why-section-head h2 { font-size:clamp(28px,4vw,44px); font-weight:800; color:#111; margin:0; }
        .why-section-head span { color: var(--accent-secondary-color); }
        .why-layout { display:grid; grid-template-columns:300px 1fr; gap:0; background:#fff; border-radius:20px; overflow:hidden; box-shadow:0 12px 60px rgba(0,0,0,0.09); min-height:460px; }
        /* Left sidebar */
        .why-sidebar { background:#111; padding:0; }
        .why-tab-btn { display:flex; align-items:center; gap:16px; width:100%; padding:20px 24px; border:none; background:transparent; cursor:pointer; border-left:4px solid transparent; transition:all 0.25s; text-align:left; border-bottom:1px solid rgba(255,255,255,0.06); }
        .why-tab-btn:hover { background:rgba(255,255,255,0.05); border-left-color: rgba(224,90,0,0.5); }
        .why-tab-btn.active { background:rgba(224,90,0,0.12); border-left-color: var(--accent-secondary-color); }
        .why-tab-num { font-size:11px; font-weight:800; color: var(--accent-secondary-color); letter-spacing:1px; min-width:24px; }
        .why-tab-label { font-size:13px; font-weight:600; color:rgba(255,255,255,0.65); line-height:1.3; transition:color 0.2s; }
        .why-tab-btn.active .why-tab-label,
        .why-tab-btn:hover .why-tab-label { color:#fff; }
        .why-tab-arrow { margin-left:auto; color: var(--accent-secondary-color); font-size:11px; opacity:0; transition:opacity 0.2s; }
        .why-tab-btn.active .why-tab-arrow { opacity:1; }
        /* Right content */
        .why-content-wrap { padding:0; position:relative; overflow:hidden; }
        .why-progress { height:4px; background:#f0f0f0; position:relative; }
        .why-progress-bar { height:100%; background: linear-gradient(90deg, var(--accent-secondary-color), #ff8c42); width:0%; transition:none; }
        .why-pane { display:none; padding:44px 48px 40px; animation: whyFadeIn 0.4s ease; }
        .why-pane.active { display:block; }
        @keyframes whyFadeIn { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }
        .why-pane-icon { width:60px; height:60px; background:rgba(224,90,0,0.10); border-radius:16px; display:flex; align-items:center; justify-content:center; margin-bottom:20px; }
        .why-pane-icon i { font-size:24px; color: var(--accent-secondary-color); }
        .why-pane-title { font-size:26px; font-weight:800; color:#111; margin:0 0 10px; }
        .why-pane-desc { font-size:15px; color:#666; line-height:1.75; margin:0 0 32px; max-width:560px; }
        .why-points-grid { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
        .why-point { display:flex; align-items:center; gap:12px; background:#f9f9f7; border-radius:10px; padding:13px 16px; border:1px solid #efefed; }
        .why-point-icon { width:28px; height:28px; background: var(--accent-secondary-color); border-radius:7px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .why-point-icon i { font-size:11px; color:#fff; }
        .why-point span { font-size:13px; font-weight:600; color:#222; }
        /* Footer row */
        .why-footer-row { display:flex; align-items:center; gap:32px; margin-top:52px; flex-wrap:wrap; }
        @media(max-width:991px) {
          .why-layout { grid-template-columns:1fr; }
          .why-sidebar { display:flex; overflow-x:auto; }
          .why-tab-btn { border-left:none; border-bottom:4px solid transparent; padding:14px 18px; flex-shrink:0; }
          .why-tab-btn.active { border-bottom-color: var(--accent-secondary-color); background:rgba(224,90,0,0.1); }
          .why-tab-arrow { display:none; }
          .why-pane { padding:28px 24px; }
          .why-points-grid { grid-template-columns:1fr; }
        }
      </style>

      <div class="why-section-wrap">
        <div class="why-section-head wow fadeInUp">
          <span style="display:inline-block; font-size:12px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:var(--accent-secondary-color); margin-bottom:12px;">What Sets Us Apart</span>
          <h2>Why Choose <span>i3 Realtors</span> ?</h2>
        </div>

        <div class="why-layout wow fadeInUp" data-wow-delay="0.15s">
          {{-- Sidebar --}}
          <div class="why-sidebar">
            @foreach($whyTabs as $i => $t)
            <button class="why-tab-btn {{ $i===0 ? 'active' : '' }}" data-target="wt-{{ $t['id'] }}" onclick="whySwitch('{{ $t['id'] }}')">
              <span class="why-tab-num">{{ $t['num'] }}</span>
              <span class="why-tab-label">{{ $t['label'] }}</span>
              <i class="fas fa-chevron-right why-tab-arrow"></i>
            </button>
            @endforeach
          </div>

          {{-- Content --}}
          <div class="why-content-wrap">
            <div class="why-progress"><div class="why-progress-bar" id="whyBar"></div></div>
            @foreach($whyTabs as $i => $t)
            <div class="why-pane {{ $i===0 ? 'active' : '' }}" id="wt-{{ $t['id'] }}">
              <div class="why-pane-icon"><i class="fa-solid {{ $t['icon'] }}"></i></div>
              <h3 class="why-pane-title">{{ $t['title'] }}</h3>
              <p class="why-pane-desc">{{ $t['desc'] }}</p>
              <div class="why-points-grid">
                @foreach($t['points'] as $pt)
                <div class="why-point">
                  <div class="why-point-icon"><i class="fas fa-check"></i></div>
                  <span>{{ $pt }}</span>
                </div>
                @endforeach
              </div>
            </div>
            @endforeach
          </div>
        </div>

        {{-- Footer CTA --}}
        @php $phoneMain = $site['phone_primary'] ?? '+91 (123) 456-789'; @endphp
        <div class="why-footer-row wow fadeInUp" data-wow-delay="0.3s">
          <a href="{{ route('contact') }}" class="btn-default">Partner With Us</a>
          <div style="display:flex; align-items:center; gap:14px;">
            <div style="width:48px; height:48px; background: var(--accent-secondary-color); border-radius:50%; display:flex; align-items:center; justify-content:center;">
              <i class="fas fa-phone" style="color:#fff; font-size:16px;"></i>
            </div>
            <div>
              <p style="margin:0; font-size:12px; color:#999; font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">Call Us Now</p>
              <a href="tel:{{ $phoneMain }}" style="font-size:17px; font-weight:800; color:#111; text-decoration:none;">{{ $phoneMain }}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Who We Are Section End -->

    <!-- Intro Video Start -->
    <div class="intro-video bg-section dark-section parallaxie">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-7 col-md-9">
            <div class="intro-video-content">
              <div class="section-title">
                <span class="section-sub-title wow fadeInUp">Video</span>
                <h2 class="text-anime-style-2" data-cursor="-opaque">
                  Building Strategic Real Estate <span>Opportunities</span>
                </h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Intro Video End -->

    <!-- Our Commitment Section Start -->
    <div class="our-commitment bg-section" style="margin: 12px auto;">
      <div class="container">
        <div class="row align-items-start">

          {{-- LEFT: Mission / Vision / CTA --}}
          <div class="col-xl-5">
            <div class="our-commitment-content">
              <div class="our-commitment-header-content">
                <div class="section-title">
                  <span class="section-sub-title wow fadeInUp">Vision & Values</span>
                  <h2 class="text-anime-style-2" data-cursor="-opaque">
                    Our Mission, Vision & Values
                  </h2>
                </div>

                {{-- Mission --}}
                <div class="wow fadeInUp" data-wow-delay="0.1s"
                     style="border-left: 3px solid var(--accent-color); padding: 16px 20px; background: var(--bg-color); border-radius: 0 12px 12px 0; margin-bottom: 20px;">
                  <span style="font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--accent-color); display: block; margin-bottom: 6px;">Our Mission</span>
                  <p style="margin: 0; font-size: 15px; line-height: 1.7; color: var(--text-color);">
                    To create a hassle-free Sales &amp; Marketing service to Developers in today's competitive market — connecting the right projects with the right buyers through strategic mandate execution.
                  </p>
                </div>

                {{-- Vision --}}
                <div class="wow fadeInUp" data-wow-delay="0.2s"
                     style="border-left: 3px solid var(--accent-secondary-color); padding: 16px 20px; background: var(--bg-color); border-radius: 0 12px 12px 0; margin-bottom: 28px;">
                  <span style="font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--accent-secondary-color); display: block; margin-bottom: 6px;">Our Vision</span>
                  <p style="margin: 0; font-size: 15px; line-height: 1.7; color: var(--text-color);">
                    To be the most trusted real estate mandate firm in India — empowering developers, unlocking investor potential, and setting the benchmark for ethical, results-driven real estate consulting.
                  </p>
                </div>

                <div class="our-commitment-btn wow fadeInUp" data-wow-delay="0.3s">
                  <a href="{{ route('contact') }}" class="btn-default">Partner With Us</a>
                </div>
              </div>

              <div class="commitment-client-box wow fadeInUp" data-wow-delay="0.5s">
                <div class="satisfy-client-images">
                  @foreach(['author-1.jpg', 'author-2.jpg', 'author-3.jpg', 'author-4.jpg'] as $a)
                  <div class="satisfy-client-image">
                    <figure class="image-anime"><img src="{{ asset('images/'.$a) }}" alt="" /></figure>
                  </div>
                  @endforeach
                  <div class="satisfy-client-image add-more"><i class="fa fa-solid fa-plus"></i></div>
                </div>
                <div class="commitment-client-box-content">
                  <p>"Building long-term partnerships between developers and investors through strategic project marketing and real estate mandate execution."</p>
                </div>
              </div>
            </div>
          </div>

          {{-- RIGHT: 6 Values in 2-column grid --}}
          <div class="col-xl-7">
            <div class="row g-3">
              @php
              $commitments = [
                ['icon' => 'fa-handshake',    'title' => 'Trust',            'desc' => 'We believe in the Power of Trust. Every developer and investor relationship we build is grounded in honesty, reliability, and long-term commitment.',       'delay' => ''],
                ['icon' => 'fa-eye',          'title' => 'Transparency',     'desc' => 'We believe in transparency in all transactions. Clear communication and open processes ensure every client knows exactly where they stand.',                   'delay' => '0.1s'],
                ['icon' => 'fa-seedling',     'title' => 'Growing Together', 'desc' => 'We believe in working together in a win-win situation. When our developer partners succeed, we succeed — shared growth drives everything we do.',              'delay' => '0.2s'],
                ['icon' => 'fa-lightbulb',    'title' => 'Innovation',       'desc' => 'We embrace modern tools, data-driven strategies, and market intelligence to keep our developer partners ahead of the competition.',                           'delay' => '0.1s'],
                ['icon' => 'fa-user-check',   'title' => 'Client-Centric',   'desc' => 'Every decision we make puts our clients first. We tailor our mandate approach to each developer\'s unique project, timeline, and market goals.',              'delay' => '0.2s'],
                ['icon' => 'fa-medal',        'title' => 'Excellence',       'desc' => 'We hold ourselves to the highest standard in every mandate we take — from project launch to final sale, excellence is non-negotiable.',                       'delay' => '0.3s'],
              ];
              @endphp
              @foreach($commitments as $c)
              <div class="col-sm-6 col-12">
                <div class="commitment-item wow fadeInUp" style="margin-bottom: 0; height: 100%;" {{ $c['delay'] ? 'data-wow-delay="'.$c['delay'].'"' : '' }}>
                  <div class="commitment-item-header">
                    <div class="icon-box" style="display:flex; align-items:center; justify-content:center;">
                      <i class="fa-solid {{ $c['icon'] }}" style="font-size:28px; color: var(--accent-secondary-color);"></i>
                    </div>
                    <div class="commitment-item-title"><h3>{{ $c['title'] }}</h3></div>
                  </div>
                  <div class="commitment-item-content">
                    <p>{{ $c['desc'] }}</p>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>

        </div>
      </div>
    </div>
    <!-- Our Commitment Section End -->

    <!-- Our Project Section Start -->
    <div class="our-project bg-section" style="margin: 12px auto; background: #f8f7f4;">
      <div class="container">
        <div class="row section-row">
          <div class="col-lg-12">
            <div class="section-title section-title-center">
              <span class="section-sub-title wow fadeInUp">Our Projects</span>
              <h2 class="text-anime-style-2" data-cursor="-opaque">
                Our Featured Real Estate <span>Opportunities</span>
              </h2>
            </div>
          </div>
        </div>

        @php $delays = ['', '0.2s', '0.4s', '0.6s']; @endphp
        <div class="row">
          @forelse($projects as $i => $project)
          <div class="col-xl-3 col-md-6">
            <div class="project-item wow fadeInUp" {{ ($delays[$i] ?? '') ? 'data-wow-delay="'.($delays[$i] ?? '').'"' : '' }}>
              <div class="project-item-image">
                <a href="#" data-cursor-text="View">
                  <figure><img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}" /></figure>
                </a>
              </div>
              <div class="project-item-content">
                <ul><li><a href="#">{{ $project->type_label }}</a></li></ul>
                <h2><a href="#">{{ $project->title }}</a></h2>
              </div>
            </div>
          </div>
          @empty
          <div class="col-12 text-center py-5">
            <p style="color:#aaa;">No ongoing featured projects available yet.</p>
          </div>
          @endforelse

          <div class="col-lg-12">
            <div class="section-footer-text section-satisfy-img wow fadeInUp" data-wow-delay="0.4s">
              <div class="satisfy-client-images">
                <div class="satisfy-client-image">
                  <figure class="image-anime"><img src="{{ asset('images/author-1.jpg') }}" alt="" /></figure>
                </div>
                <div class="satisfy-client-image add-more">
                  <img src="{{ asset('images/icon-phone-primary.svg') }}" alt="" />
                </div>
              </div>
              @php $phone = $site['phone_primary'] ?? '+123456789'; @endphp
              <p>Explore premium real estate opportunities through our developer mandate partnerships. <a href="{{ route('website.projects.index') }}">View All Projects</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Our Project Section End -->

    {{-- Recognitions Section Start (commented out)
    <!-- Recognitions Section Start -->
    <div class="bg-section" style="margin: 12px auto; padding: 100px 0;">
      <div class="container">
        <div class="row section-row">
          <div class="col-lg-12">
            <div class="section-title section-title-center">
              <span class="section-sub-title wow fadeInUp">Awards & Affiliations</span>
              <h2 class="text-anime-style-2" data-cursor="-opaque">
                Recognitions & <span>Associations</span>
              </h2>
              <p class="wow fadeInUp" data-wow-delay="0.2s" style="max-width:620px; margin: 0 auto;">
                Our experience includes working with and representing some of the most recognized names in the real estate industry.
              </p>
            </div>
          </div>
        </div>

        @if($recognitions->isNotEmpty())
        <div class="row justify-content-center g-4 wow fadeInUp" data-wow-delay="0.3s">
          @foreach($recognitions as $rec)
          <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
            <div style="border: 1px solid #eeeeee; border-radius: 8px; transition: all 0.3s ease; cursor: default; overflow: hidden;"
                 onmouseover="this.style.borderColor='var(--accent-secondary-color)'; this.style.boxShadow='0 4px 20px rgba(200,169,106,0.15)';"
                 onmouseout="this.style.borderColor='#eeeeee'; this.style.boxShadow='none';">
              <div style="width: 100%; height: 110px; overflow: hidden;">
                <img src="{{ asset('uploads/' . $rec->logo) }}" alt="{{ $rec->name }}" style="width:100%; height:100%; object-fit:contain;">
              </div>
              @if($rec->name)
              <p style="font-size:16px; color:#888; margin:0; padding: 8px 6px; font-weight:600;">{{ $rec->name }}</p>
              @endif
            </div>
          </div>
          @endforeach
        </div>
        @else
        <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.3s">
          <div class="col-lg-8 text-center">
            <p style="color: #aaa; font-size: 14px;">Recognition logos will appear here once added from the admin panel.</p>
          </div>
        </div>
        @endif
      </div>
    </div>
    <!-- Recognitions Section End -->
    --}}

    <!-- Testimonials Section Start -->
    <div class="bg-section" style="margin: 12px auto; padding: 100px 0;">
      <div class="container">
        <div class="row section-row">
          <div class="col-lg-12">
            <div class="section-title section-title-center">
              <span class="section-sub-title wow fadeInUp">Client Feedback</span>
              <h2 class="text-anime-style-2" data-cursor="-opaque">
                What Our Clients <span>Say</span>
              </h2>
              <p class="wow fadeInUp" data-wow-delay="0.2s">Real feedback from developers, investors, and homebuyers we've worked with.</p>
            </div>
          </div>
        </div>

        @if($testimonials->isNotEmpty())
        <div class="row g-4">
          @foreach($testimonials as $i => $testimonial)
          <div class="col-xl-4 col-md-6">
            <div class="wow fadeInUp" data-wow-delay="{{ ['','0.2s','0.4s','','0.2s','0.4s'][$i] ?? '' }}"
                 style="background:#ffffff; border-radius:12px; padding:32px; height:100%; display:flex; flex-direction:column; border: 1px solid #f0f0f0; box-shadow: 0 2px 20px rgba(0,0,0,0.04);">
              {{-- Stars --}}
              <div style="margin-bottom:16px;">
                @for($s = 1; $s <= 5; $s++)
                  <i class="fas fa-star" style="color: {{ $s <= $testimonial->rating ? '#f4b400' : '#e0e0e0' }}; font-size:14px;"></i>
                @endfor
              </div>
              {{-- Video or Text --}}
              @if($testimonial->video_url)
              <div style="margin-bottom:16px; border-radius:8px; overflow:hidden; aspect-ratio:16/9;">
                <iframe src="{{ str_replace('watch?v=', 'embed/', $testimonial->video_url) }}" style="width:100%;height:100%;border:0;" allowfullscreen loading="lazy"></iframe>
              </div>
              @endif
              <p style="color:#555; font-size:14px; line-height:1.7; flex:1; font-style:normal;">"{{ $testimonial->content }}"</p>
              <div style="display:flex; align-items:center; gap:12px; margin-top:20px; padding-top:20px; border-top:1px solid #f5f5f5;">
                @if($testimonial->author_image)
                <img src="{{ asset('uploads/' . $testimonial->author_image) }}" alt="{{ $testimonial->author_name }}"
                     style="width:48px; height:48px; border-radius:50%; object-fit:cover; flex-shrink:0;">
                @else
                <div style="width:48px; height:48px; border-radius:50%; background: linear-gradient(135deg, var(--accent-secondary-color), #c8a96a); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                  <span style="color:#fff; font-size:18px; font-weight:700;">{{ strtoupper(substr($testimonial->author_name, 0, 1)) }}</span>
                </div>
                @endif
                <div>
                  <p style="font-weight:700; color:#111; margin:0; font-size:14px;">{{ $testimonial->author_name }}</p>
                  <p style="color:#888; margin:0; font-size:12px;">
                    {{ $testimonial->author_title ?? '' }}
                    @if($testimonial->company) &nbsp;•&nbsp; {{ $testimonial->company }} @endif
                    @if($testimonial->client_type) &nbsp;<span style="background:rgba(200,169,106,0.15); color:var(--accent-secondary-color); padding:2px 8px; border-radius:20px; font-size:10px; font-weight:700;">{{ $testimonial->client_type }}</span> @endif
                  </p>
                  @if($testimonial->project_name)
                  <p style="color:#aaa; margin:2px 0 0; font-size:11px;">{{ $testimonial->project_name }}</p>
                  @endif
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        @else
        <div class="row wow fadeInUp" data-wow-delay="0.3s">
          <div class="col-lg-8 offset-lg-2">
            <div style="background:#ffffff; border-radius:12px; padding:40px; border: 1px solid #f0f0f0;">
              <div style="margin-bottom:16px;">
                @for($s = 0; $s < 5; $s++)<i class="fas fa-star" style="color:#f4b400; font-size:16px;"></i>@endfor
              </div>
              <p style="color:#555; font-size:15px; line-height:1.7; font-style:normal;">"i3 Realtors helped us structure and market our project efficiently. Their investor network and sales strategy delivered strong results within a short timeline."</p>
              <div style="display:flex; align-items:center; gap:12px; margin-top:20px; padding-top:20px; border-top:1px solid #f5f5f5;">
                <div style="width:48px; height:48px; border-radius:50%; background: linear-gradient(135deg, var(--accent-secondary-color), #c8a96a); display:flex; align-items:center; justify-content:center;">
                  <span style="color:#fff; font-size:18px; font-weight:700;">D</span>
                </div>
                <div>
                  <p style="font-weight:700; color:#111; margin:0; font-size:14px;">Developer Partner</p>
                  <p style="color:#888; margin:0; font-size:12px;"><span style="background:rgba(200,169,106,0.15); color:var(--accent-secondary-color); padding:2px 8px; border-radius:20px; font-size:10px; font-weight:700;">Developer</span></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
    <!-- Testimonials Section End -->

    <!-- Properties CTA Start -->
    <div style="background: #0F0F0F; padding: 100px 0; border-top: 1px solid rgba(200,169,106,0.2); border-bottom: 1px solid rgba(200,169,106,0.2);">
        <div class="container">
            <div class="row align-items-center justify-content-between g-4">
                <div class="col-lg-8">
                    <span style="font-size: 12px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--accent-secondary-color); opacity: 0.85;">Investment Opportunities</span>
                    <h2 style="font-size: 2rem; font-weight: 800; color: #ffffff; margin: 8px 0 12px;">Browse Available Investment Opportunities</h2>
                    <p style="font-size: 15px; color: rgba(255,255,255,0.65); margin: 0;">Explore residential and commercial real estate projects available through our developer mandate partnerships.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('properties.index') }}" class="btn-default"
                       style="display: inline-block; padding: 14px 36px; font-size: 15px; font-weight: 700; border-radius: 8px; background: var(--accent-secondary-color); color: #0F0F0F; text-decoration: none; border: 2px solid var(--accent-secondary-color);">
                        <i class="fas fa-building me-2"></i>View All Opportunities
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Properties CTA End -->

    {{-- Our Fact Section Start (commented out)
    <div class="our-fact">
      <div class="container">
        <div class="row section-row">
          <div class="col-lg-12">
            <div class="section-title section-title-center">
              <span class="section-sub-title wow fadeInUp">Experience & Network</span>
              <h2 class="text-anime-style-2" data-cursor="-opaque">
                Experience That Drives Real <span>Estate Success</span>
              </h2>
            </div>
          </div>
        </div>

        <div class="row align-items-center">
          <div class="col-xl-6">
            <div class="our-fact-image-box">
              <div class="our-fact-image-box-1 wow fadeInUp">
                <div class="our-fact-image">
                  <figure class="image-anime">
                    <img src="{{ asset('images/our-fact-image-1.jpg') }}" alt="" />
                  </figure>
                </div>
                <div class="our-fact-image-content">
                  <p>"Partnering with i3 Realtors has helped us position our projects strategically and connect with the right investors. Their market understanding and professional execution make them a reliable mandate partner."</p>
                </div>
              </div>
              <div class="our-fact-image-box-2">
                <div class="our-fact-image">
                  <figure class="image-anime reveal">
                    <img src="{{ asset('images/our-fact-image-2.jpg') }}" alt="" />
                  </figure>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="fact-item-list wow fadeInUp" data-wow-delay="0.2s">
              @php
              $facts = [
                ['count' => '25', 'label' => 'Developer Partnerships'],
                ['count' => '50', 'label' => 'Projects Marketed'],
                ['count' => '500', 'label' => 'Investor & Partner Network'],
                ['count' => '300', 'label' => 'Successful Deal Closures'],
              ];
              @endphp
              @foreach($facts as $fact)
              <div class="fact-item">
                <div class="fact-item-title"><ul><li>i3 Realtors</li></ul></div>
                <div class="fact-item-counter-content">
                  <h2><span class="counter">{{ $fact['count'] }}</span>+</h2>
                  <p>{{ $fact['label'] }}</p>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    Our Fact Section End --}}

    <!-- Cta Box Section Start -->
    <div class="cta-box bg-section dark-section parallaxie" style="margin: 12px auto;">
      <div class="container">
        <div class="row">
          <div class="col-xl-12 text-center">
            <div class="section-title section-title-center">
              <span class="section-sub-title wow fadeInUp">Get In Touch</span>
              <h2 class="text-anime-style-2" data-cursor="-opaque">
                Partner With <span>i3 Realtors</span>
              </h2>
              <p class="wow fadeInUp" data-wow-delay="0.3s">Whether you are a developer launching a new project or an investor exploring strategic opportunities, i3 Realtors helps connect the right projects with the right partners.</p>
            </div>
            <div class="wow fadeInUp" data-wow-delay="0.4s">
              <a href="{{ route('contact') }}" class="btn-default btn-highlighted me-3">Start A Partnership</a>
              <a href="{{ route('contact') }}" class="btn-default">Contact Our Team</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Cta Box Section End -->

@endsection

@push('styles')
<style>
@keyframes logoScroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
.developer-logo-track:hover { animation-play-state: paused; }
</style>
@endpush

@push('scripts')
@if($heroSettings['fluid_animation'])
<script src="{{ asset('js/fluid.js') }}"></script>
@endif
<script>
(function () {
    var btns    = document.querySelectorAll('.why-tab-btn');
    var panes   = document.querySelectorAll('.why-pane');
    var bar     = document.getElementById('whyBar');
    var current = 0;
    var DURATION = 5000;
    var timer, barAnim;

    function showTab(idx) {
        btns.forEach(function(b){ b.classList.remove('active'); });
        panes.forEach(function(p){ p.classList.remove('active'); });
        btns[idx].classList.add('active');
        panes[idx].classList.add('active');
        current = idx;
        startBar();
    }

    function startBar() {
        if (bar) {
            bar.style.transition = 'none';
            bar.style.width = '0%';
            requestAnimationFrame(function(){
                requestAnimationFrame(function(){
                    bar.style.transition = 'width ' + DURATION + 'ms linear';
                    bar.style.width = '100%';
                });
            });
        }
    }

    function startTimer() {
        clearInterval(timer);
        timer = setInterval(function () {
            showTab((current + 1) % btns.length);
        }, DURATION);
    }

    window.whySwitch = function(id) {
        var idx = Array.from(btns).findIndex(function(b){ return b.dataset.target === 'wt-' + id; });
        if (idx !== -1) {
            showTab(idx);
            startTimer();
        }
    };

    if (btns.length) {
        startBar();
        startTimer();
    }
})();
</script>
@endpush
