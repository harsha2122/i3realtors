@extends('layouts.website')

@section('title', \App\Models\Setting::get('meta_title', 'i3Realtors - Smart Real Estate & Reliable Construction'))
@section('meta_description', \App\Models\Setting::get('meta_description', ''))

@section('content')

    <!-- Hero Section Start -->
    <div class="hero hero-video bg-section dark-section">
      <div class="hero-bg-video">
        <video autoplay muted loop id="myvideo">
          <source src="https://demo.awaikenthemes.com/assets/videos/skyvilla-video.mp4" type="video/mp4" />
        </video>
      </div>

      <div class="container">
        <div class="row align-items-end">
          <div class="col-xl-6">
            <div class="hero-content-box">
              <div class="section-title">
                <span class="section-sub-title wow fadeInUp">{{ \App\Models\Setting::get('site_tagline', 'Building Trust. Creating Value.') }}</span>
                <h1 class="text-anime-style-2" data-cursor="-opaque">
                  Smart real estate <span>reliable construction</span>
                </h1>
              </div>
            </div>
          </div>

          <div class="col-xl-6">
            <div class="hero-counter-box">
              <div class="hero-counter-list wow fadeInUp">
                <div class="hero-counter-item">
                  <h2><span class="counter">25</span>+</h2>
                  <p>Year of Experience</p>
                </div>
                <div class="hero-counter-item">
                  <h2><span class="counter">50</span>+</h2>
                  <p>Expert Team Member</p>
                </div>
                <div class="hero-counter-item">
                  <h2><span class="counter">500</span>+</h2>
                  <p>Project Completed</p>
                </div>
              </div>

              <div class="hero-counter-footer wow fadeInUp" data-wow-delay="0.2s">
                <div class="hero-btn">
                  <a href="{{ route('contact') }}" class="btn-default btn-highlighted">Get Free Consultation</a>
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
                    <p>Our Word Wide Customer Review</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Hero Section End -->

    <!-- About US Section Start -->
    <div class="about-us">
      <div class="container">
        <div class="row section-row align-items-center">
          <div class="col-xl-7">
            <div class="section-title">
              <span class="section-sub-title wow fadeInUp">About Our Construction</span>
              <h2 class="text-anime-style-2" data-cursor="-opaque">
                Trusted builders creating modern <span>spaces with integrity</span>
              </h2>
            </div>
          </div>
          <div class="col-xl-5">
            <div class="section-content-btn">
              <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                <p>We are trusted builders committed to delivering modern, quality spaces built with honesty, precision, and care.</p>
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
                <a href="{{ route('projects.index') }}">
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
                    <h3>Your Trusted Partners</h3>
                    <p>We stand by you at every stage of the construction journey</p>
                  </div>
                  <div class="about-us-item-image">
                    <figure>
                      <img src="{{ asset('images/about-us-item-image-1.png') }}" alt="" />
                    </figure>
                  </div>
                </div>

                <div class="about-us-item box-2">
                  <div class="about-us-item-content">
                    <h3>Modern Design Solution</h3>
                    <p>We stand by you at every stage of the construction journey</p>
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
                  <p>Real Estate Expertise</p>
                </div>
                <div class="about-counter-item">
                  <h2><span class="counter">50</span>+</h2>
                  <p>Expert Team Members</p>
                </div>
                <div class="about-counter-item">
                  <h2><span class="counter">500</span>+</h2>
                  <p>Handed-Over Project</p>
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
                Reliable services for real <span>estate and construction</span>
              </h2>
            </div>
          </div>
        </div>

        <div class="row service-item-list">
          @php
          $services = [
            ['img' => 'service-1.jpg', 'icon' => 'icon-service-item-1.svg', 'title' => 'Residential Construction', 'desc' => 'We build high-quality durability, and modern living.', 'delay' => ''],
            ['img' => 'service-2.jpg', 'icon' => 'icon-service-item-2.svg', 'title' => 'Commercial Construction', 'desc' => 'We build high-quality durability, and modern living.', 'delay' => '0.2s'],
            ['img' => 'service-3.jpg', 'icon' => 'icon-service-item-3.svg', 'title' => 'Project Management', 'desc' => 'We build high-quality durability, and modern living.', 'delay' => '0.4s'],
            ['img' => 'service-4.jpg', 'icon' => 'icon-service-item-4.svg', 'title' => 'Design & Planning', 'desc' => 'We build high-quality durability, and modern living.', 'delay' => '0.6s'],
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
              <p>Complete Real Estate And Construction Solutions - <a href="{{ route('services') }}">View all services.</a></p>
              <ul>
                <li><span class="counter">4.9</span>/5</li>
                <li>
                  <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </li>
                <li>Our 4200 Review</li>
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
              <span class="section-sub-title wow fadeInUp">Who We Are</span>
              <h2 class="wow fadeInUp" data-wow-delay="0.2s">
                Shaping residential and commercial <span>spaces with expertise</span>
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
                        <img src="{{ asset('images/icon-who-we-tab-1.svg') }}" alt="" /> Industry Experts
                      </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="second-tab" data-bs-toggle="tab" data-bs-target="#second" type="button" role="tab" aria-selected="false">
                        <img src="{{ asset('images/icon-who-we-tab-2.svg') }}" alt="" /> Trusted Builders
                      </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="third-tab" data-bs-toggle="tab" data-bs-target="#third" type="button" role="tab" aria-selected="false">
                        <img src="{{ asset('images/icon-who-we-tab-3.svg') }}" alt="" /> Modern Designers
                      </button>
                    </li>
                  </ul>
                </div>

                @php
                $tabs = [
                  ['id' => 'first', 'title' => 'Industry Experts:', 'active' => true],
                  ['id' => 'second', 'title' => 'Trusted builders:', 'active' => false],
                  ['id' => 'third', 'title' => 'Modern Designers:', 'active' => false],
                ];
                $items = [
                  ['icon' => 'icon-who-we-item-1.svg', 'text' => 'Experience Professional'],
                  ['icon' => 'icon-who-we-item-2.svg', 'text' => 'Strong Safety Standards'],
                  ['icon' => 'icon-who-we-item-3.svg', 'text' => 'Client-Focused Approach'],
                  ['icon' => 'icon-who-we-item-4.svg', 'text' => 'Quality Craftsmanship'],
                ];
                @endphp

                @foreach($tabs as $tab)
                <div class="who-we-tab-item tab-pane fade {{ $tab['active'] ? 'show active' : '' }}" id="{{ $tab['id'] }}" role="tabpanel">
                  <div class="who-we-tab-content">
                    <div class="who-we-tab-header-content">
                      <h3>{{ $tab['title'] }}</h3>
                      <p>We are known for delivering high-quality construction with honesty, precision, and reliability. Every project is handled with strong craftsmanship, transparent processes, and a commitment to meeting timelines.</p>
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
                @php $phoneMain = \App\Models\Setting::get('phone_primary', '+91 (123) 456-789'); @endphp
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
                  <div class="who-we-cta-content"><p>Our 5k+ Satisfice Client</p></div>
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
                <span class="section-sub-title wow fadeInUp">Watch Video</span>
                <h2 class="text-anime-style-2" data-cursor="-opaque">
                  Watch how we build <span>modern quality living spaces</span>
                </h2>
              </div>
            </div>
          </div>
          <div class="col-xl-5 col-md-3">
            <div class="watch-video-circle">
              <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video" data-cursor-text="Play">
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
                    Dedicated to honest & <span>reliable construction</span>
                  </h2>
                  <p class="wow fadeInUp" data-wow-delay="0.2s">
                    We are committed to delivering construction services built on honesty, reliability, and transparency from planning to completion.
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
                  <p>"Creating modern homes and commercial spaces precision construction and trusted real estate expertise."</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-7">
            <div class="our-commitment-item-list">
              @php
              $commitments = [
                ['icon' => 'icon-commitment-item-1.svg', 'title' => 'Quality Craftsmanship - Superior construction with attention to detail', 'delay' => ''],
                ['icon' => 'icon-commitment-item-2.svg', 'title' => 'Sustainability - Durable and environmentally conscious practices', 'delay' => '0.2s'],
                ['icon' => 'icon-commitment-item-3.svg', 'title' => 'Modern Techniques - Innovative construction and design methods', 'delay' => '0.4s'],
              ];
              @endphp
              @foreach($commitments as $c)
              <div class="commitment-item wow fadeInUp" {{ $c['delay'] ? 'data-wow-delay="'.$c['delay'].'"' : '' }}>
                <div class="commitment-item-header">
                  <div class="icon-box"><img src="{{ asset('images/'.$c['icon']) }}" alt="" /></div>
                  <div class="commitment-item-title"><h3>{{ $c['title'] }}</h3></div>
                </div>
                <div class="commitment-item-content">
                  <p>We prioritize quality craftsmanship in every project, ensuring that every detail is executed with precision and care.</p>
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
                Our work defined by precision <span>strength And Integrity</span>
              </h2>
            </div>
          </div>
        </div>

        <div class="row">
          @php
          $projects = [
            ['img' => 'project-image-1.jpg', 'cat' => 'Residential', 'title' => 'The Vertex Plaza', 'delay' => ''],
            ['img' => 'project-image-2.jpg', 'cat' => 'Commercial', 'title' => 'Aurelia Business Park', 'delay' => '0.2s'],
            ['img' => 'project-image-3.jpg', 'cat' => 'Industrial', 'title' => 'Project Completion', 'delay' => '0.4s'],
            ['img' => 'project-image-4.jpg', 'cat' => 'Infrastructure', 'title' => 'Crown Point Commercial', 'delay' => '0.6s'],
          ];
          @endphp
          @foreach($projects as $p)
          <div class="col-xl-3 col-md-6">
            <div class="project-item wow fadeInUp" {{ $p['delay'] ? 'data-wow-delay="'.$p['delay'].'"' : '' }}>
              <div class="project-item-image">
                <a href="{{ route('projects.index') }}" data-cursor-text="View">
                  <figure><img src="{{ asset('images/'.$p['img']) }}" alt="{{ $p['title'] }}" /></figure>
                </a>
              </div>
              <div class="project-item-content">
                <ul><li><a href="{{ route('projects.index') }}">{{ $p['cat'] }}</a></li></ul>
                <h2><a href="{{ route('projects.index') }}">{{ $p['title'] }}</a></h2>
              </div>
            </div>
          </div>
          @endforeach

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
              @php $phone = \App\Models\Setting::get('phone_primary', '+123456789'); @endphp
              <p>Let's make something great work together. <a href="tel:{{ $phone }}">Get Free Quote</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Our Project Section End -->

    <!-- Our Fact Section Start -->
    <div class="our-fact">
      <div class="container">
        <div class="row section-row">
          <div class="col-lg-12">
            <div class="section-title section-title-center">
              <span class="section-sub-title wow fadeInUp">Our Fact</span>
              <h2 class="text-anime-style-2" data-cursor="-opaque">
                Facts that showcase experience <span>quality and reliability</span>
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
                  <p>"We are extremely satisfied with quality of construction and attention to detail."</p>
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
                ['count' => '25', 'label' => 'Year Experience Real Estate'],
                ['count' => '50', 'label' => 'Our Expert Team Members'],
                ['count' => '500', 'label' => 'Project Completed Real Estate'],
                ['count' => '300', 'label' => 'Our Trusted Happy Homeowner'],
              ];
              @endphp
              @foreach($facts as $fact)
              <div class="fact-item">
                <div class="fact-item-title"><ul><li>Residential</li></ul></div>
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
                Ready to start your <span>construction project?</span>
              </h2>
            </div>
            <div class="wow fadeInUp" data-wow-delay="0.4s">
              <a href="{{ route('contact') }}" class="btn-default btn-highlighted me-3">Get Free Quote</a>
              <a href="{{ route('about') }}" class="btn-default">Learn More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Cta Box Section End -->

@endsection
