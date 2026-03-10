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
                    <span class="section-sub-title wow fadeInUp">About Our Construction</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">Trusted builders creating modern spaces with integrity</h2>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="col-xl-5">
                <!-- Section Content Button Start -->
                <div class="section-content-btn">
                    <!-- Section Title Content Start -->
                    <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                        <p>We are trusted builders committed to delivering modern, quality spaces built with honesty, precision, and care.</p>
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
                                <p>We stand by you at every stage of the construction journey</p>
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
                                <h3>Modern Design Solution</h3>
                                <p>We stand by you at every stage of the construction journey</p>
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
                            <p>Years of Expertise</p>
                        </div>
                        <!-- About Counter Item End -->

                        <!-- About Counter Item Start -->
                        <div class="about-counter-item">
                            <h2><span class="counter">50</span>+</h2>
                            <p>Expert Team Members</p>
                        </div>
                        <!-- About Counter Item End -->

                        <!-- About Counter Item Start -->
                        <div class="about-counter-item">
                            <h2><span class="counter">500</span>+</h2>
                            <p>Completed Projects</p>
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
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Our strategic approach to quality construction</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">We follow a strategic, detail-driven approach that combines careful planning, skilled execution and strict quality standards to deliver durable, high-value construction projects.</p>
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
                                <p>Our mission is to build lasting value with quality craftsmanship and integrity in every project.</p>
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
                                <p>To be the trusted partner for modern, sustainable construction solutions that transform communities.</p>
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
                                <p>Integrity, quality, and accountability are at our core. We deliver projects that stand the test of time.</p>
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
                        <span class="section-sub-title wow fadeInUp">Our History</span>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Our journey of growth and construction excellence</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">Our journey reflects steady growth, industry expertise, and a commitment to construction excellence, built through years of successful projects and trusted client relationships.</p>
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
                            <h2>2010</h2>
                            <div class="history-item-content">
                                <h3>Foundation & Vision</h3>
                                <p>Our journey began in 2010 with a clear vision to deliver dependable, high-quality construction solutions to our community.</p>
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
                            <h2>2014</h2>
                            <div class="history-item-content">
                                <h3>Early Growth & First Milestone</h3>
                                <p>By 2014, we had successfully completed numerous residential and commercial projects, establishing ourselves as a trusted name in construction.</p>
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
                            <h2>2018</h2>
                            <div class="history-item-content">
                                <h3>Expertise Development</h3>
                                <p>In 2018, we expanded our team and services, incorporating modern construction techniques and sustainable building practices.</p>
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
                            <h2>2024</h2>
                            <div class="history-item-content">
                                <h3>Present & Future Vision</h3>
                                <p>Today, we continue to lead the industry with innovation, sustainability, and a commitment to delivering excellence in every project.</p>
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

@endsection
