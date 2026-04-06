@extends('layouts.website')
@section('title', 'Contact Us - ' . ($site['site_name'] ?? config('app.name')))
@section('content')

<!-- Page Header Start -->
<div class="page-header bg-section parallaxie" style="background-image: url({{ asset('images/page-header-bg.jpg') }}); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center 9px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque">Contact Us</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('contact') }}">Contact Us</a></li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Contact Section Start -->
<div class="page-contact-us">
    <div class="container">
        <div class="row">
            <div class="col-xl-5">
                <!-- Contact Us Content Start -->
                <div class="contact-us-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <span class="section-sub-title wow fadeInUp">Contact Us</span>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">We're ready to discuss your next real estate opportunity</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">At i3 Realtors, we work closely with developers, investors, and strategic partners to create structured real estate opportunities. Whether you're exploring developer mandates, project partnerships, or investment opportunities, our team is ready to assist you with the right strategy and guidance.

Reach out to us and our team will get back to you shortly.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Contact Info List Start -->
                    <div class="contact-info-list">
                        <!-- Contact Info Item Start -->
                        <div class="contact-info-item wow fadeInUp">
                            <h2><a href="mailto:i3realtorsllp@gmail.com">i3realtorsllp@gmail.com</a></h2>
                            <h2><a href="mailto:admin@i3realtors.com">admin@i3realtors.com</a></h2>
                        </div>
                        <!-- Contact Info Item End -->

                        <!-- Contact Info Item Start -->
                        <div class="contact-info-item wow fadeInUp" data-wow-delay="0.2s">
                            <h4>Address:</h4>
                            <p>i3 Realtors<br>Office No. 04, Sector No. 01, Plot No. 20<br>White House, Amchi Colony<br>Bavdhan, Pune 411021<br>Maharashtra, India</p>
                        </div>
                        <!-- Contact Info Item End -->

                        <!-- Contact Us Social List Start -->
                        <div class="contact-us-social-list wow fadeInUp" data-wow-delay="0.4s">
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-pinterest-p"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        <!-- Contact Us Social List End -->
                    </div>
                    <!-- Contact Info List End -->
                </div>
                <!-- Contact Us Content End -->
            </div>

            <div class="col-xl-7">
                <!-- Contact Form Start -->
                <div class="contact-form">
                    <form action="{{ route('contact.submit') }}" method="POST" class="wow fadeInUp" data-wow-delay="0.4s">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6 mb-4">
                                <label>First Name:</label>
                                <input type="text" name="first_name" class="form-control" placeholder="Enter First Name *" required>
                                @error('first_name')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group col-md-6 mb-4">
                                <label>Last Name:</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name *" required>
                                @error('last_name')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group col-md-6 mb-4">
                                <label>Email Address:</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email Address *" required>
                                @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group col-md-6 mb-4">
                                <label>Phone Number:</label>
                                <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number *" required>
                                @error('phone')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group col-md-12 mb-5">
                                <label>Message:</label>
                                <textarea name="message" class="form-control" rows="5" placeholder="Any Additional Message..." required></textarea>
                                @error('message')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn-default">Send Message</button>
                                @if(session('success'))
                                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Contact Form End -->
            </div>
        </div>
    </div>
</div>
<!-- Contact Section End -->

<!-- Location Section Start -->
<div class="google-map">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title section-title-center">
                    <span class="section-sub-title wow fadeInUp">Our Location</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">Visit Our Office</h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">Our office is located in Bavdhan, Pune. You can visit us to discuss developer mandates, real estate investments, and strategic project partnerships. We welcome developers, investors, and partners to connect with our team.</p>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Google Map Start -->
                <div class="google-map-iframe wow fadeInUp" data-wow-delay="0.4s">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3783.2729248837622!2d73.7817771!3d18.5165648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2bf3a3995297f%3A0x9583666fec8bda50!2si3%20Realtors%20LLP!5e0!3m2!1sen!2sin!4v1773748275394!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <!-- Google Map End -->
            </div>
        </div>
    </div>
</div>
<!-- Location Section End -->

<!-- CTA Box Section Start -->
<div class="cta-box bg-section dark-section parallaxie" @if(!empty($site['cta_bg_image'])) style="background-image:url('{{ asset('uploads/'.$site['cta_bg_image']) }}');" @endif>
    <div class="container">
        <div class="row">
            <div class="col-xl-12 text-center">
                <div class="section-title section-title-center">
                    <span class="section-sub-title wow fadeInUp">Partnership</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">
                        Partner with i3 Realtors
                    </h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">If you are a developer launching a new project or an investor looking for structured opportunities, i3 Realtors provides the strategic guidance and partnerships needed to move forward with confidence.</p>
                </div>
                <div class="wow fadeInUp" data-wow-delay="0.4s">
                    <a href="{{ route('website.projects.index') }}" class="btn-default btn-highlighted me-3">Explore Opportunities</a>
                    <a href="{{ route('about') }}" class="btn-default">Learn More About Us</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CTA Box Section End -->

@endsection
