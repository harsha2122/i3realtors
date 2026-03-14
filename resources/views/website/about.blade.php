@extends('layouts.website')
@section('title', 'About Us - ' . ($site['site_name'] ?? config('app.name')))
@section('content')

<!-- Page Header Start -->
<div class="page-header bg-section parallaxie" style="background-image: url({{ asset('images/page-header-bg.jpg') }}); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center 9px;">
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
<div class="about-us">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-xl-7">
                <!-- Section Title Start -->
                <div class="section-title">
                    <span class="section-sub-title wow fadeInUp">About i3 Realtors</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">Trusted real estate mandate partners for developers and investors</h2>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="col-xl-5">
                <!-- Section Content Button Start -->
                <div class="section-content-btn">
                    <!-- Section Title Content Start -->
                    <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                        <p>i3 Realtors is a mandate-focused real estate consulting firm working with developers, investors, and strategic partners to structure, market, and execute successful real estate opportunities. Our role goes beyond traditional brokerage. We work closely with developers to position projects strategically, build market visibility, and connect them with the right investor and buyer networks.</p>
                    </div>
                    <!-- Section Title Content End -->

                    <!-- Section Button Start -->
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.4s">
                        <a href="{{ route('contact') }}" class="btn-default">Contact Now</a>
                    </div>
                    <!-- Section Button End -->
                </div>
                <!-- Section Content Button End -->
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <!-- About US Image Box Start -->
                <div class="about-us-image-box wow fadeInUp">
                    <!-- About Us Image Start -->
                    <div class="about-us-image">
                        <figure class="image-anime">
                            <img src="{{ asset('images/about-us-image.jpg') }}" alt="About Us">
                        </figure>
                    </div>
                    <!-- About Us Image End -->

                    <!-- About Us Circle Start -->
                    <div class="about-us-circle">
                        <a href="{{ route('projects.index') }}">
                            <img src="{{ asset('images/circle-project.png') }}" alt="">
                        </a>
                    </div>
                    <!-- About Us Circle End -->
                </div>
                <!-- About Us Image Box End -->
            </div>

            <div class="col-xl-6">
                <!-- About Us Content Box Start -->
                <div class="about-us-content-box wow fadeInUp" data-wow-delay="0.2s">
                    <!-- About Us Item List Start -->
                    <div class="about-us-item-list">
                        <!-- About Us Item Start -->
                        <div class="about-us-item box-1">
                            <!-- About Us Item Content Start -->
                            <div class="about-us-item-content">
                                <h3>Your Trusted Partners</h3>
                                <p>We support developers and investors at every stage of the real estate lifecycle—from project positioning and marketing strategy to investor outreach and partnership development.</p>
                            </div>
                            <!-- About Us Item Content End -->

                            <!-- About Us Item Image Start -->
                            <div class="about-us-item-image">
                                <figure>
                                    <img src="{{ asset('images/about-us-item-image-1.png') }}" alt="">
                                </figure>
                            </div>
                            <!-- About Us Item Image End -->
                        </div>
                        <!-- About Us Item End -->

                        <!-- About Us Item Start -->
                        <div class="about-us-item box-2">
                            <!-- About Us Item Content Start -->
                            <div class="about-us-item-content">
                                <h3>Strategic Market Expertise</h3>
                                <p>Our experience in the real estate sector enables us to identify market opportunities, structure mandate partnerships, and deliver measurable results for developers and investors.</p>
                            </div>
                            <!-- About Us Item Content End -->

                            <!-- About Us Item Image Start -->
                            <div class="about-us-item-image">
                                <figure class="image-anime">
                                    <img src="{{ asset('images/about-us-item-image-2.jpg') }}" alt="">
                                </figure>
                            </div>
                            <!-- About Us Item Image End -->
                        </div>
                        <!-- About Us Item End -->
                    </div>
                    <!-- About Us Item List End -->

                    <!-- About Counter List Start -->
                    <div class="about-counter-item-list">
                        <!-- About Counter Item Start -->
                        <div class="about-counter-item">
                            <h2><span class="counter">25</span>+</h2>
                            <p>Developer Partnerships</p>
                        </div>
                        <!-- About Counter Item End -->

                        <!-- About Counter Item Start -->
                        <div class="about-counter-item">
                            <h2><span class="counter">50</span>+</h2>
                            <p>Projects Represented</p>
                        </div>
                        <!-- About Counter Item End -->

                        <!-- About Counter Item Start -->
                        <div class="about-counter-item">
                            <h2><span class="counter">500</span>+</h2>
                            <p>Investor Network</p>
                        </div>
                        <!-- About Counter Item End -->
                    </div>
                    <!-- About Counter List End -->
                </div>
                <!-- About Us Content Box End -->
            </div>
        </div>
    </div>
</div>
<!-- About Us Section End -->

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
                        <h2 class="text-anime-style-2" data-cursor="-opaque">A strategic approach to real estate partnerships</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">At i3 Realtors, we follow a structured approach that combines market intelligence, strategic marketing, and strong developer relationships to ensure every project receives the visibility and positioning it deserves. Our goal is to build long-term partnerships with developers and investors by delivering reliable execution and measurable outcomes.</p>
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
                                <p>To empower developers and investors by creating structured real estate opportunities that deliver long-term value, transparency, and strategic growth.</p>
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
                                <p>Integrity, professionalism, and accountability guide everything we do. We believe in building relationships based on trust, transparency, and consistent performance.</p>
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
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Building partnerships and real estate expertise</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">Our journey reflects steady growth, strong partnerships, and a commitment to delivering strategic real estate solutions. Over the years, i3 Realtors has developed strong relationships with developers and investors while expanding its network and market presence.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Explore Project Circle Start -->
                    <div class="explore-project-circle wow fadeInUp" data-wow-delay="0.4s">
                        <a href="{{ route('projects.index') }}">
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
                            <h2>2018</h2>
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
                            <h2>2020</h2>
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
                            <h2>2022</h2>
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
                        Partner with i3 Realtors for your next <span>real estate opportunity</span>
                    </h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">Whether you are a developer launching a new project or an investor exploring structured opportunities, i3 Realtors provides the expertise, market insights, and partnerships required to succeed.</p>
                </div>
                <div class="wow fadeInUp" data-wow-delay="0.4s">
                    <a href="{{ route('contact') }}" class="btn-default btn-highlighted me-3">Connect With Us</a>
                    <a href="{{ route('projects.index') }}" class="btn-default">Explore Opportunities</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CTA Box Section End -->

@endsection
