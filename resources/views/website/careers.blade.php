@extends('layouts.website')
@section('title', 'Careers - ' . ($site['site_name'] ?? config('app.name')))
@section('content')

<!-- Page Header Start -->
<div class="page-header bg-dark parallaxie" style="background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url({{ asset('images/page-header-bg.jpg') }}); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center 9px; padding: 120px 0 60px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-white text-anime-style-2" data-cursor="-opaque">Build Your Career With Us</h1>
                    <p class="text-white-50 mt-3">Join our team and grow with industry leaders in construction</p>
                    <nav class="wow fadeInUp mt-4">
                        <ol class="breadcrumb breadcrumb-light">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active text-white">Careers</li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Why Join Section Start -->
<div class="why-join-section py-5" style="background-color: #ffffff;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="wow fadeInLeft">
                    <h2 class="mb-4">Why Join i3 Realtors?</h2>
                    <p class="text-muted mb-4">We believe in building more than just projects—we build careers and futures.</p>
                    <ul class="benefits-list">
                        <li>
                            <div class="benefit-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div>
                                <h5>Competitive Compensation</h5>
                                <p>Attractive salary packages and comprehensive benefits</p>
                            </div>
                        </li>
                        <li>
                            <div class="benefit-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div>
                                <h5>Professional Development</h5>
                                <p>Training and growth opportunities for all team members</p>
                            </div>
                        </li>
                        <li>
                            <div class="benefit-icon">
                                <i class="fas fa-people-group"></i>
                            </div>
                            <div>
                                <h5>Collaborative Culture</h5>
                                <p>Work with experienced professionals and industry experts</p>
                            </div>
                        </li>
                        <li>
                            <div class="benefit-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div>
                                <h5>Career Growth</h5>
                                <p>Clear advancement paths and leadership opportunities</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="wow fadeInRight" data-wow-delay="0.2s">
                    <img src="{{ asset('images/careers-image.jpg') }}" alt="Careers" class="img-fluid rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Why Join Section End -->

<!-- Open Positions Start -->
<div class="open-positions py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-12 text-center">
                <h2 class="mb-3">Current Open Positions</h2>
                <p class="text-muted">We're hiring talented professionals. Browse our open opportunities below.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="position-card wow fadeInUp">
                    <div class="position-badge badge-dark">Full-Time</div>
                    <h4 class="position-title">Site Engineer</h4>
                    <p class="position-meta"><i class="fas fa-map-marker-alt"></i> On-Site | <i class="fas fa-briefcase"></i> 3-5 Years Experience</p>
                    <p class="position-desc">Oversee construction projects and ensure quality standards are met. Lead teams and manage day-to-day site operations.</p>
                    <a href="#apply-form" class="btn-apply">Apply Now <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="position-card wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-badge badge-dark">Full-Time</div>
                    <h4 class="position-title">Project Manager</h4>
                    <p class="position-meta"><i class="fas fa-map-marker-alt"></i> Office/On-Site | <i class="fas fa-briefcase"></i> 5+ Years Experience</p>
                    <p class="position-desc">Lead construction projects from conception to completion. Manage budgets, timelines, and teams with excellence.</p>
                    <a href="#apply-form" class="btn-apply">Apply Now <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="position-card wow fadeInUp" data-wow-delay="0.2s">
                    <div class="position-badge badge-dark">Full-Time</div>
                    <h4 class="position-title">CAD Draftsman</h4>
                    <p class="position-meta"><i class="fas fa-map-marker-alt"></i> Office | <i class="fas fa-briefcase"></i> 2-3 Years Experience</p>
                    <p class="position-desc">Create detailed architectural and construction drawings using AutoCAD and design software. Support our design team.</p>
                    <a href="#apply-form" class="btn-apply">Apply Now <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="position-card wow fadeInUp" data-wow-delay="0.3s">
                    <div class="position-badge badge-dark">Full-Time</div>
                    <h4 class="position-title">Safety Officer</h4>
                    <p class="position-meta"><i class="fas fa-map-marker-alt"></i> On-Site | <i class="fas fa-briefcase"></i> 3-5 Years Experience</p>
                    <p class="position-desc">Ensure workplace safety compliance and conduct regular safety audits. Maintain high safety standards across all sites.</p>
                    <a href="#apply-form" class="btn-apply">Apply Now <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Open Positions End -->

<!-- Application Form Start -->
<div class="application-section py-5" id="apply-form">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="form-header text-center mb-5">
                    <h2 class="mb-3">Submit Your Application</h2>
                    <p class="text-muted">Fill out the form below and we'll get back to you shortly</p>
                </div>

                <form action="{{ route('careers.submit') }}" method="POST" enctype="multipart/form-data" class="career-form">
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
                            <button type="submit" class="btn-submit">
                                <span>Submit Application</span>
                                <i class="fas fa-paper-plane"></i>
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
.breadcrumb-light .breadcrumb-item a {
    color: rgba(255, 255, 255, 0.8);
}
.breadcrumb-light .breadcrumb-item a:hover {
    color: white;
}

.benefits-list {
    list-style: none;
    padding: 0;
}

.benefits-list li {
    display: flex;
    margin-bottom: 30px;
    gap: 20px;
}

.benefit-icon {
    flex-shrink: 0;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--primary-color), rgba(184, 150, 43, 0.1));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
}

.benefits-list h5 {
    margin: 0 0 8px 0;
    font-weight: 600;
    color: var(--primary-color, #b8962b);
}

.benefits-list p {
    margin: 0;
    font-size: 14px;
    color: #666;
}

.position-card {
    background: white;
    border: 1px solid #e8e8e8;
    border-radius: 12px;
    padding: 30px;
    position: relative;
    transition: all 0.3s ease;
    height: 100%;
}

.position-card:hover {
    border-color: var(--primary-color);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transform: translateY(-5px);
}

.position-badge {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 15px;
    background: var(--primary-color, #b8962b);
    color: white;
}

.position-title {
    font-size: 20px;
    font-weight: 700;
    color: var(--primary-color, #b8962b);
    margin-bottom: 10px;
}

.position-meta {
    font-size: 13px;
    color: #666;
    margin-bottom: 15px;
}

.position-meta i {
    margin-right: 6px;
    color: var(--primary-color);
}

.position-desc {
    font-size: 15px;
    color: #555;
    line-height: 1.6;
    margin-bottom: 20px;
}

.btn-apply {
    display: inline-block;
    background: var(--primary-color, #b8962b);
    color: white;
    padding: 12px 24px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    font-size: 14px;
}

.btn-apply:hover {
    background: rgba(184, 150, 43, 0.8);
    color: white;
    transform: translateX(5px);
}

.btn-apply i {
    margin-left: 8px;
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

.btn-submit {
    width: 100%;
    background: linear-gradient(135deg, var(--primary-color, #b8962b), rgba(184, 150, 43, 0.8));
    color: white;
    padding: 15px 40px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.btn-submit:hover {
    background: linear-gradient(135deg, rgba(184, 150, 43, 0.8), var(--primary-color, #b8962b));
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(184, 150, 43, 0.3);
}

.btn-submit:active {
    transform: translateY(0);
}

.form-header {
    margin-bottom: 40px;
}

.form-header h2 {
    font-size: 32px;
    font-weight: 700;
    color: var(--primary-color, #b8962b);
}

.bg-light {
    background-color: #f8f9fa;
}

@media (max-width: 768px) {
    .position-card {
        padding: 20px;
    }

    .benefits-list li {
        margin-bottom: 20px;
    }

    .benefit-icon {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
}
</style>

@endsection
