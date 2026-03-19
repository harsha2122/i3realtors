@extends('layouts.website')

@section('title', $site['meta_title'] ?? 'i3Realtors - Smart Real Estate & Reliable Construction')
@section('meta_description', $site['meta_description'] ?? '')

@section('content')

    <!-- Hero Section Start -->
    <div class="hero hero-video bg-section dark-section" style="position:relative; overflow:hidden;">
      <canvas id="fluidCanvas" style="position:absolute; top:0; left:0; width:100%; height:100%; z-index:0;"></canvas>

      <div class="container" style="position:relative; z-index:1;">
        <div class="row align-items-end">
          <div class="col-xl-6">
            <div class="hero-content-box">
              <div class="section-title">
                <span class="section-sub-title wow fadeInUp">Invest in India</span>
                <h1 class="text-anime-style-2" data-cursor="-opaque">
                  Strategic real estate mandates for <span>Developers & Investors</span>
                </h1>
              </div>
            </div>
          </div>

          <div class="col-xl-6">
            <div class="hero-counter-box">
              <div class="hero-counter-list wow fadeInUp">
                <div class="hero-counter-item">
                  <h2><span class="counter">25</span>+</h2>
                  <p>Developer Partnerships</p>
                </div>
                <div class="hero-counter-item">
                  <h2><span class="counter">50</span>+</h2>
                  <p>Projects Handled</p>
                </div>
                <div class="hero-counter-item">
                  <h2><span class="counter">500</span>+</h2>
                  <p>Investor Network</p>
                </div>
              </div>

              <div class="hero-counter-footer wow fadeInUp" data-wow-delay="0.2s">
                <div class="hero-btn">
                  <a href="{{ route('website.projects.index') }}" class="btn-default btn-highlighted">Explore Projects</a>
                  <a href="{{ route('contact') }}" class="btn-default" style="margin-left: 10px;">Partner With Us</a>
                </div>
                <div class="hero-rating-box">
                  <div class="hero-rating-box-header">
                    <h3><span class="counter">4.9</span></h3>
                    <p>
                      <i class="fa fa-solid fa-star"></i>
                      <i class="fa fa-solid fa-star"></i>
                      <i class="fa fa-solid fa-star"></i>
                      <i class="fa fa-solid fa-star"></i>
                      <i class="fa fa-solid fa-star"></i>
                    </p>
                  </div>
                  <div class="hero-rating-box-content">
                    <p>Trusted by Developers & Investment Partners<br>⭐ 4.9 Client Satisfaction Rating</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Hero Section End -->

    <!-- Trusted Developers Section Start -->
    <div style="background: #0a0a0a; padding: 100px 0; border-bottom: 1px solid rgba(200,169,106,0.15);">
      <div class="container">
        <div class="row section-row">
          <div class="col-lg-12">
            <div class="section-title section-title-center">
              <span class="section-sub-title wow fadeInUp">Our Developer Partners</span>
              <h2 class="text-anime-style-2" data-cursor="-opaque" style="color:#ffffff;">
                Trusted by Leading <span>Developers</span>
              </h2>
              <p class="wow fadeInUp" data-wow-delay="0.2s" style="color:rgba(255,255,255,0.65); max-width:680px; margin: 0 auto 16px;">
                We have partnered with leading real estate developers across Pune and Mumbai to deliver structured mandate sales, marketing strategies, and investor-driven growth.
              </p>
              <div class="wow fadeInUp" data-wow-delay="0.3s" style="color: var(--accent-secondary-color); font-size: 13px; font-weight: 700; letter-spacing: 1px; margin-bottom: 40px;">
                25+ Developer Partnerships &nbsp;|&nbsp; 1500+ Channel Partners &nbsp;|&nbsp; 1.8M+ Sq.ft Sold
              </div>
            </div>
          </div>
        </div>

        @if($developerLogos->isNotEmpty())
        <div class="wow fadeInUp" data-wow-delay="0.4s" style="overflow: hidden; position: relative;">
          <div class="developer-logo-track" style="display: flex; gap: 40px; align-items: center; animation: logoScroll 30s linear infinite;">
            @foreach($developerLogos->concat($developerLogos) as $devLogo)
            <div class="developer-logo-item" style="flex-shrink: 0; min-width: 200px; text-align: center;">
              @if($devLogo->link)
              <a href="{{ $devLogo->link }}" target="_blank" rel="noopener noreferrer">
              @endif
              <img src="{{ asset('uploads/' . $devLogo->logo) }}" alt="{{ $devLogo->name }}"
                   style="max-height: 200px; max-width: 200px; object-fit: contain; filter: grayscale(100%); opacity: 0.6; transition: all 0.3s ease;"
                   onmouseover="this.style.filter='grayscale(0%)'; this.style.opacity='1';"
                   onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.6';">
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
              <div style="padding: 12px 24px; background: rgba(255,255,255,0.05); border: 1px solid rgba(200,169,106,0.2); border-radius: 6px;">
                <span style="color: rgba(255,255,255,0.5); font-size: 13px; font-weight: 600; letter-spacing: 0.5px;">{{ $devName }}</span>
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
    <div class="about-us">
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
                  <img src="{{ asset('images/about-us-image.jpg') }}" alt="About i3Realtors" />
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
                      <img src="{{ asset('images/about-us-item-image-1.png') }}" alt="" />
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
                      <img src="{{ asset('images/about-us-item-image-2.jpg') }}" alt="" />
                    </figure>
                  </div>
                </div>
              </div>

              <div class="about-counter-item-list">
                <div class="about-counter-item">
                  <h2><span class="counter">25</span>+</h2>
                  <p>Developer Partnerships</p>
                </div>
                <div class="about-counter-item">
                  <h2><span class="counter">50</span>+</h2>
                  <p>Projects Represented</p>
                </div>
                <div class="about-counter-item">
                  <h2><span class="counter">500</span>+</h2>
                  <p>Investor Network</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- About US Section End -->

    <!-- Our Service Section Start -->
    <div class="our-service bg-section">
      <div class="container">
        <div class="row section-row">
          <div class="col-lg-12">
            <div class="section-title section-title-center">
              <span class="section-sub-title wow fadeInUp">Our Services</span>
              <h2 class="text-anime-style-2" data-cursor="-opaque">
                Reliable Services for Real <span>Estate Development</span>
              </h2>
            </div>
          </div>
        </div>

        <div class="row service-item-list">
          @php
          $services = [
            ['img' => 'service-1.jpg', 'icon' => 'icon-service-item-1.svg', 'title' => 'Developer Mandate Services', 'desc' => 'We partner with developers as mandate consultants to manage project positioning, marketing strategy, and sales execution.', 'delay' => ''],
            ['img' => 'service-2.jpg', 'icon' => 'icon-service-item-2.svg', 'title' => 'Project Marketing Strategy', 'desc' => 'From project launch to sustained demand generation, we design structured marketing strategies tailored to each development.', 'delay' => '0.2s'],
            ['img' => 'service-3.jpg', 'icon' => 'icon-service-item-3.svg', 'title' => 'Real Estate Investment Advisory', 'desc' => 'We guide investors in identifying high-potential opportunities across residential and commercial developments.', 'delay' => '0.4s'],
            ['img' => 'service-4.jpg', 'icon' => 'icon-service-item-4.svg', 'title' => 'Developer Partnerships', 'desc' => 'Building long-term collaborations with developers to structure real estate mandates and maximize project visibility.', 'delay' => '0.6s'],
          ];
          @endphp

          @foreach($services as $i => $svc)
          <div class="col-xl-3 col-md-6">
            <div class="service-item {{ $i === 0 ? 'active' : '' }} wow fadeInUp" {{ $svc['delay'] ? 'data-wow-delay="'.$svc['delay'].'"' : '' }}>
              <div class="service-item-image">
                <figure>
                  <img src="{{ asset('images/'.$svc['img']) }}" alt="{{ $svc['title'] }}" />
                </figure>
              </div>
              <div class="service-item-body">
                <div class="icon-box">
                  <img src="{{ asset('images/'.$svc['icon']) }}" alt="" />
                </div>
                <div class="service-item-body-content">
                  <div class="service-item-content">
                    <h2><a href="{{ route('services') }}">{{ $svc['title'] }}</a></h2>
                    <p>{{ $svc['desc'] }}</p>
                  </div>
                  <div class="service-item-btn">
                    <a href="{{ route('services') }}" class="readmore-btn">View Details</a>
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
    <div class="who-we-are">
      <div class="container">
        <div class="row section-row">
          <div class="col-lg-12">
            <div class="section-title section-title-center">
              <span class="section-sub-title wow fadeInUp">Why Choose Us</span>
              <h2 class="wow fadeInUp" data-wow-delay="0.2s">
                Why Developers Partner With <span>i3 Realtors</span>
              </h2>
            </div>
          </div>
        </div>

        <div class="row align-items-center">
          <div class="col-xl-6">
            <div class="who-we-content wow fadeInUp">
              <div class="who-we-box tab-content" id="mvTabContent">
                <div class="who-we-nav">
                  <ul class="nav nav-tabs" id="mvTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="first-tab" data-bs-toggle="tab" data-bs-target="#first" type="button" role="tab" aria-selected="true">
                        <img src="{{ asset('images/icon-who-we-tab-1.svg') }}" alt="" /> Strategic Understanding
                      </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="second-tab" data-bs-toggle="tab" data-bs-target="#second" type="button" role="tab" aria-selected="false">
                        <img src="{{ asset('images/icon-who-we-tab-2.svg') }}" alt="" /> Mandate Execution
                      </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="third-tab" data-bs-toggle="tab" data-bs-target="#third" type="button" role="tab" aria-selected="false">
                        <img src="{{ asset('images/icon-who-we-tab-3.svg') }}" alt="" /> Investor Network
                      </button>
                    </li>
                  </ul>
                </div>

                @php
                $tabs = [
                  ['id' => 'first', 'title' => 'Strategic Understanding:', 'active' => true],
                  ['id' => 'second', 'title' => 'Mandate Execution:', 'active' => false],
                  ['id' => 'third', 'title' => 'Investor Network:', 'active' => false],
                ];
                $items = [
                  ['icon' => 'icon-who-we-item-1.svg', 'text' => 'Market Analysis'],
                  ['icon' => 'icon-who-we-item-2.svg', 'text' => 'Strategic Positioning'],
                  ['icon' => 'icon-who-we-item-3.svg', 'text' => 'Demand Generation'],
                  ['icon' => 'icon-who-we-item-4.svg', 'text' => 'Buyer Connection'],
                ];
                @endphp

                @foreach($tabs as $tab)
                <div class="who-we-tab-item tab-pane fade {{ $tab['active'] ? 'show active' : '' }}" id="{{ $tab['id'] }}" role="tabpanel">
                  <div class="who-we-tab-content">
                    <div class="who-we-tab-header-content">
                      <h3>{{ $tab['title'] }}</h3>
                      <p>We combine deep market intelligence with structured execution to deliver measurable results. Our mandate partnerships ensure developers receive dedicated focus and strategic positioning in every market segment.</p>
                    </div>
                    <div class="who-we-item-list">
                      @foreach($items as $item)
                      <div class="who-we-item">
                        <div class="icon-box">
                          <img src="{{ asset('images/'.$item['icon']) }}" alt="" />
                        </div>
                        <div class="who-we-item-content">
                          <h3>{{ $item['text'] }}</h3>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                @endforeach
              </div>

              <div class="who-we-footer">
                <div class="who-we-btn">
                  <a href="{{ route('contact') }}" class="btn-default">Contact Us</a>
                </div>
                @php $phoneMain = $site['phone_primary'] ?? '+91 (123) 456-789'; @endphp
                <div class="about-us-contact-box">
                  <div class="icon-box">
                    <img src="{{ asset('images/icon-headphone-primary.svg') }}" alt="" />
                  </div>
                  <div class="about-us-conatct-content">
                    <p>Call Us Now!</p>
                    <h3><a href="tel:{{ $phoneMain }}">{{ $phoneMain }}</a></h3>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-6">
            <div class="who-we-image-box">
              <div class="who-we-image-box-1">
                <div class="who-we-image">
                  <figure class="image-anime reveal">
                    <img src="{{ asset('images/who-we-are-image-1.jpg') }}" alt="" />
                  </figure>
                </div>
              </div>
              <div class="who-we-image-box-2">
                <div class="who-we-cta-box wow fadeInUp" data-wow-delay="0.2s">
                  <div class="satisfy-client-images">
                    @foreach(['author-1.jpg', 'author-2.jpg', 'author-3.jpg', 'author-4.jpg'] as $a)
                    <div class="satisfy-client-image">
                      <figure class="image-anime"><img src="{{ asset('images/'.$a) }}" alt="" /></figure>
                    </div>
                    @endforeach
                    <div class="satisfy-client-image add-more"><i class="fa-solid fa-plus"></i></div>
                  </div>
                  <div class="who-we-cta-rating">
                    <span>
                      @for($s = 0; $s < 5; $s++)<i class="fa fa-solid fa-star"></i>@endfor
                    </span>
                  </div>
                  <div class="who-we-cta-content">
                    <p>Trusted by 25+ Real Estate Developers</p>
                    <small>Strategic Mandate Partnerships</small>
                  </div>
                </div>
                <div class="who-we-image">
                  <figure class="image-anime reveal">
                    <img src="{{ asset('images/who-we-are-image-2.jpg') }}" alt="" />
                  </figure>
                </div>
              </div>
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
          <div class="col-xl-5 col-md-3">
            <div class="watch-video-circle">
              <a href="{{ route('website.projects.index') }}" data-cursor-text="View Projects">
                <img src="{{ asset('images/watch-video-circle.png') }}" alt="" />
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Intro Video End -->

    <!-- Our Commitment Section Start -->
    <div class="our-commitment">
      <div class="container">
        <div class="row">
          <div class="col-xl-5">
            <div class="our-commitment-content">
              <div class="our-commitment-header-content">
                <div class="section-title">
                  <span class="section-sub-title wow fadeInUp">Our Commitment</span>
                  <h2 class="text-anime-style-2" data-cursor="-opaque">
                    Committed to Integrity & <span>Long-Term Partnerships</span>
                  </h2>
                  <p class="wow fadeInUp" data-wow-delay="0.2s">
                    Real estate development requires more than just marketing—it demands strategic positioning, trusted relationships, and a deep understanding of the market dynamics.
                  </p>
                </div>
                <div class="our-commitment-btn wow fadeInUp" data-wow-delay="0.4s">
                  <a href="{{ route('contact') }}" class="btn-default">Contact Us</a>
                </div>
              </div>
              <div class="commitment-client-box wow fadeInUp" data-wow-delay="0.6s">
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

          <div class="col-xl-7">
            <div class="our-commitment-item-list">
              @php
              $commitments = [
                ['icon' => 'icon-commitment-item-1.svg', 'title' => 'Structured Mandate Execution - Dedicated focus and strategic marketing strategies', 'delay' => ''],
                ['icon' => 'icon-commitment-item-2.svg', 'title' => 'Transparency & Professionalism - Honest relationships with consistent execution', 'delay' => '0.2s'],
                ['icon' => 'icon-commitment-item-3.svg', 'title' => 'Market Expertise - Deep understanding of market dynamics and buyer behavior', 'delay' => '0.4s'],
              ];
              @endphp
              @foreach($commitments as $c)
              <div class="commitment-item wow fadeInUp" {{ $c['delay'] ? 'data-wow-delay="'.$c['delay'].'"' : '' }}>
                <div class="commitment-item-header">
                  <div class="icon-box"><img src="{{ asset('images/'.$c['icon']) }}" alt="" /></div>
                  <div class="commitment-item-title"><h3>{{ $c['title'] }}</h3></div>
                </div>
                <div class="commitment-item-content">
                  <p>We focus on transparency, professionalism, and consistent execution to ensure every project we represent achieves maximum visibility and impact.</p>
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
    <div class="our-project bg-section dark-section">
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
            <div class="project-item wow fadeInUp" {{ $delays[$i] ? 'data-wow-delay="'.$delays[$i].'"' : '' }}>
              <div class="project-item-image">
                <a href="{{ route('website.projects.show', $project->slug) }}" data-cursor-text="View">
                  <figure><img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}" /></figure>
                </a>
              </div>
              <div class="project-item-content">
                <ul><li><a href="{{ route('website.projects.show', $project->slug) }}">{{ $project->type_label }}</a></li></ul>
                <h2><a href="{{ route('website.projects.show', $project->slug) }}">{{ $project->title }}</a></h2>
              </div>
            </div>
          </div>
          @empty
          <div class="col-12 text-center py-5">
            <p style="color: rgba(255,255,255,0.5);">No projects available yet.</p>
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

    <!-- Recognitions Section Start -->
    <div class="bg-section" style="margin: 60px 0; padding: 100px 0;">
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
                <img src="{{ asset('uploads/' . $rec->logo) }}" alt="{{ $rec->name }}" style="width:100%; height:100%; object-fit:cover;">
              </div>
              @if($rec->name)
              <p style="font-size:11px; color:#888; margin:0; padding: 8px 6px; font-weight:600;">{{ $rec->name }}</p>
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

    <!-- Testimonials Section Start -->
    <div class="bg-section" style="padding: 100px 0;">
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
              <p style="color:#555; font-size:14px; line-height:1.7; flex:1; font-style:italic;">"{{ $testimonial->content }}"</p>
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
              <p style="color:#555; font-size:15px; line-height:1.7; font-style:italic;">"i3 Realtors helped us structure and market our project efficiently. Their investor network and sales strategy delivered strong results within a short timeline."</p>
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

    <!-- Our Fact Section Start -->
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
    <!-- Our Fact Section End -->

    <!-- Cta Box Section Start -->
    <div class="cta-box bg-section dark-section parallaxie">
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
<script src="https://cdn.jsdelivr.net/gh/Libero793/KNGURUWebsite3.0@latest/js/script.js" defer></script>
@endpush
