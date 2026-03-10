@extends('layouts.website')
@section('title', 'Careers - ' . ($site['site_name'] ?? config('app.name')))
@section('content')

<!-- Page Header Start -->
<div class="page-header bg-section parallaxie" style="background-image: url({{ asset('images/page-header-bg.jpg') }}); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center 9px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque">Careers</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('careers') }}">Careers</a></li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Career Opportunities Section Start -->
<div class="about-us">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-xl-7">
                <!-- Section Title Start -->
                <div class="section-title">
                    <span class="section-sub-title wow fadeInUp">Build Your Future</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">Join our team and grow with industry leaders in construction</h2>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="col-xl-5">
                <!-- Section Content Button Start -->
                <div class="section-content-btn">
                    <!-- Section Title Content Start -->
                    <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                        <p>We believe in building more than just projects—we build careers, develop talent, and create opportunities for professionals who are passionate about excellence.</p>
                    </div>
                    <!-- Section Title Content End -->

                    <!-- Section Button Start -->
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.4s">
                        <a href="#apply-form" class="btn-default">Apply Now</a>
                    </div>
                    <!-- Section Button End -->
                </div>
                <!-- Section Content Button End -->
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <!-- Career Image Box Start -->
                <div class="about-us-image-box wow fadeInUp">
                    <!-- Career Image Start -->
                    <div class="about-us-image">
                        <figure class="image-anime">
                            <img src="{{ asset('images/careers-image.jpg') }}" alt="Careers">
                        </figure>
                    </div>
                    <!-- Career Image End -->
                </div>
                <!-- Career Image Box End -->
            </div>

            <div class="col-xl-6">
                <!-- Career Content Box Start -->
                <div class="about-us-content-box wow fadeInUp" data-wow-delay="0.2s">
                    <!-- Why Join List Start -->
                    <div class="about-us-item-list">
                        <!-- Why Join Item Start -->
                        <div class="about-us-item box-1">
                            <!-- Why Join Item Content Start -->
                            <div class="about-us-item-content">
                                <h3>Competitive Compensation</h3>
                                <p>Attractive salary packages and comprehensive benefits for all team members</p>
                            </div>
                            <!-- Why Join Item Content End -->
                        </div>
                        <!-- Why Join Item End -->

                        <!-- Why Join Item Start -->
                        <div class="about-us-item box-2">
                            <!-- Why Join Item Content Start -->
                            <div class="about-us-item-content">
                                <h3>Professional Growth</h3>
                                <p>Training, mentorship, and advancement opportunities to develop your career</p>
                            </div>
                            <!-- Why Join Item Content End -->
                        </div>
                        <!-- Why Join Item End -->
                    </div>
                    <!-- Why Join List End -->

                    <!-- Career Highlights Start -->
                    <div class="about-counter-item-list">
                        <!-- Career Highlight Start -->
                        <div class="about-counter-item">
                            <h2><span class="counter">50</span>+</h2>
                            <p>Team Members</p>
                        </div>
                        <!-- Career Highlight End -->

                        <!-- Career Highlight Start -->
                        <div class="about-counter-item">
                            <h2><span class="counter">25</span>+</h2>
                            <p>Years Experience</p>
                        </div>
                        <!-- Career Highlight End -->
                    </div>
                    <!-- Career Highlights End -->
                </div>
                <!-- Career Content Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Career Opportunities Section End -->

<!-- Open Positions Section Start -->
<div class="our-approach bg-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <!-- Section Title Start -->
                <div class="section-title text-center mb-5">
                    <span class="section-sub-title wow fadeInUp">What We're Looking For</span>
                    <h2 class="text-anime-style-2 mb-4" data-cursor="-opaque">Current Open Positions</h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">We're hiring talented professionals to join our growing team. Explore our open opportunities below.</p>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <!-- Position Start -->
            <div class="col-xl-6">
                <div class="approach-item wow fadeInUp">
                    <div class="icon-box">
                        <i class="fas fa-hardhat"></i>
                    </div>
                    <div class="approach-item-content">
                        <h3>Site Engineer</h3>
                        <p>Oversee construction projects, ensure quality standards, and lead site teams. Requires 3-5 years experience in on-site project management.</p>
                        <a href="#apply-form" class="btn-apply-small">Apply Now</a>
                    </div>
                </div>
            </div>
            <!-- Position End -->

            <!-- Position Start -->
            <div class="col-xl-6">
                <div class="approach-item wow fadeInUp" data-wow-delay="0.1s">
                    <div class="icon-box">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="approach-item-content">
                        <h3>Project Manager</h3>
                        <p>Lead construction projects from conception to completion. Manage budgets, timelines, and teams with excellence. 5+ years required.</p>
                        <a href="#apply-form" class="btn-apply-small">Apply Now</a>
                    </div>
                </div>
            </div>
            <!-- Position End -->

            <!-- Position Start -->
            <div class="col-xl-6">
                <div class="approach-item wow fadeInUp" data-wow-delay="0.2s">
                    <div class="icon-box">
                        <i class="fas fa-pencil-ruler"></i>
                    </div>
                    <div class="approach-item-content">
                        <h3>CAD Draftsman</h3>
                        <p>Create detailed architectural and construction drawings using AutoCAD and design software. Support our design team. 2-3 years experience.</p>
                        <a href="#apply-form" class="btn-apply-small">Apply Now</a>
                    </div>
                </div>
            </div>
            <!-- Position End -->

            <!-- Position Start -->
            <div class="col-xl-6">
                <div class="approach-item wow fadeInUp" data-wow-delay="0.3s">
                    <div class="icon-box">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="approach-item-content">
                        <h3>Safety Officer</h3>
                        <p>Ensure workplace safety compliance and conduct regular audits. Maintain high safety standards across all sites. 3-5 years required.</p>
                        <a href="#apply-form" class="btn-apply-small">Apply Now</a>
                    </div>
                </div>
            </div>
            <!-- Position End -->
        </div>
    </div>
</div>
<!-- Open Positions Section End -->

<!-- Application Form Start -->
<div class="our-history" id="apply-form">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 mb-5">
                <!-- Form Title Start -->
                <div class="section-title text-center">
                    <span class="section-sub-title wow fadeInUp">Ready to Join Us?</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">Submit Your Application</h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">Fill out the form below and we'll get back to you shortly.</p>
                </div>
                <!-- Form Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 mx-auto">
                <form action="{{ route('careers.submit') }}" method="POST" enctype="multipart/form-data" class="career-form wow fadeInUp" data-wow-delay="0.2s">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6 mb-4">
                            <label class="form-label fw-semibold">Full Name *</label>
                            <input type="text" name="full_name" class="form-control form-control-lg" placeholder="Your Full Name" required>
                            @error('full_name')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-6 mb-4">
                            <label class="form-label fw-semibold">Email Address *</label>
                            <input type="email" name="email" class="form-control form-control-lg" placeholder="your@email.com" required>
                            @error('email')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-6 mb-4">
                            <label class="form-label fw-semibold">Phone Number *</label>
                            <input type="text" name="phone" class="form-control form-control-lg" placeholder="Your Phone Number" required>
                            @error('phone')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-6 mb-4">
                            <label class="form-label fw-semibold">Position Applying For *</label>
                            <select name="position" class="form-control form-control-lg" required>
                                <option value="">-- Select Position --</option>
                                <option value="Site Engineer">Site Engineer</option>
                                <option value="Project Manager">Project Manager</option>
                                <option value="CAD Draftsman">CAD Draftsman</option>
                                <option value="Safety Officer">Safety Officer</option>
                            </select>
                            @error('position')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-12 mb-4">
                            <label class="form-label fw-semibold">Years of Experience *</label>
                            <input type="number" name="experience_years" class="form-control form-control-lg" placeholder="Years" required>
                            @error('experience_years')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-12 mb-4">
                            <label class="form-label fw-semibold">Cover Letter *</label>
                            <textarea name="cover_letter" class="form-control form-control-lg" rows="5" placeholder="Tell us about yourself and why you'd like to join our team..." required></textarea>
                            @error('cover_letter')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-12 mb-4">
                            <label class="form-label fw-semibold">Upload Resume (PDF) *</label>
                            <div class="file-input-wrapper">
                                <input type="file" name="resume" id="resume" class="form-control form-control-lg" accept=".pdf" required>
                                <small class="text-muted d-block mt-2">Maximum file size: 5MB</small>
                            </div>
                            @error('resume')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn-default w-100">
                                Submit Application
                            </button>
                            @if(session('success'))
                                <div class="alert alert-success mt-4" role="alert">
                                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Application Form End -->

<style>
.btn-apply-small {
    display: inline-block;
    margin-top: 15px;
    color: var(--primary-color);
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 14px;
}

.btn-apply-small:hover {
    color: rgba(184, 150, 43, 0.7);
}

.form-control-lg {
    height: 48px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    font-size: 15px;
    transition: all 0.3s ease;
}

.form-control-lg:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(184, 150, 43, 0.1);
}

.form-label {
    font-size: 14px;
    color: #333;
    margin-bottom: 10px;
}

.file-input-wrapper input[type="file"] {
    padding: 12px;
}

.career-form .btn-default {
    width: 100%;
    padding: 15px 40px;
}

@media (max-width: 768px) {
    .form-control-lg {
        height: 44px;
        font-size: 14px;
    }
}
</style>

@endsection
