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

<!-- Careers Section Start -->
<div class="careers-section">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title section-title-center">
                    <span class="section-sub-title wow fadeInUp">Join Our Team</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">Build Your Career With Us</h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">We're always looking for talented professionals who share our passion for excellence and innovation in construction.</p>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Why Join Us Start -->
                <div class="why-join-us">
                    <div class="row align-items-center mb-5">
                        <div class="col-md-6">
                            <div class="wow fadeInUp">
                                <h3>Why Join i3 Realtors?</h3>
                                <ul class="benefits-list">
                                    <li><i class="fas fa-check"></i> Competitive Salary & Benefits</li>
                                    <li><i class="fas fa-check"></i> Professional Development Opportunities</li>
                                    <li><i class="fas fa-check"></i> Work with Industry Experts</li>
                                    <li><i class="fas fa-check"></i> Modern Work Environment</li>
                                    <li><i class="fas fa-check"></i> Career Growth Path</li>
                                    <li><i class="fas fa-check"></i> Collaborative Team Culture</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="wow fadeInUp" data-wow-delay="0.2s">
                                <img src="{{ asset('images/careers-image.jpg') }}" alt="Careers" class="img-fluid rounded">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Why Join Us End -->

                <!-- Available Positions Start -->
                <div class="available-positions mt-5">
                    <h3 class="mb-4">Current Open Positions</h3>

                    <div class="position-card wow fadeInUp mb-4">
                        <div class="position-header">
                            <h4>Site Engineer</h4>
                            <span class="badge badge-primary">Full-Time</span>
                        </div>
                        <p class="position-meta"><strong>Location:</strong> On-Site | <strong>Experience:</strong> 3-5 Years</p>
                        <p>We're seeking an experienced Site Engineer to oversee construction projects and ensure quality standards are met.</p>
                        <a href="#apply-form" class="btn btn-sm btn-primary">Apply Now</a>
                    </div>

                    <div class="position-card wow fadeInUp mb-4" data-wow-delay="0.2s">
                        <div class="position-header">
                            <h4>Project Manager</h4>
                            <span class="badge badge-primary">Full-Time</span>
                        </div>
                        <p class="position-meta"><strong>Location:</strong> Office/On-Site | <strong>Experience:</strong> 5+ Years</p>
                        <p>Lead our construction projects from conception to completion. Manage budgets, timelines, and teams with excellence.</p>
                        <a href="#apply-form" class="btn btn-sm btn-primary">Apply Now</a>
                    </div>

                    <div class="position-card wow fadeInUp mb-4" data-wow-delay="0.4s">
                        <div class="position-header">
                            <h4>CAD Draftsman</h4>
                            <span class="badge badge-success">Full-Time</span>
                        </div>
                        <p class="position-meta"><strong>Location:</strong> Office | <strong>Experience:</strong> 2-3 Years</p>
                        <p>Create detailed architectural and construction drawings using AutoCAD and other design software.</p>
                        <a href="#apply-form" class="btn btn-sm btn-primary">Apply Now</a>
                    </div>

                    <div class="position-card wow fadeInUp mb-4" data-wow-delay="0.6s">
                        <div class="position-header">
                            <h4>Safety Officer</h4>
                            <span class="badge badge-danger">Full-Time</span>
                        </div>
                        <p class="position-meta"><strong>Location:</strong> On-Site | <strong>Experience:</strong> 3-5 Years</p>
                        <p>Ensure workplace safety compliance and conduct regular safety audits across all construction sites.</p>
                        <a href="#apply-form" class="btn btn-sm btn-primary">Apply Now</a>
                    </div>
                </div>
                <!-- Available Positions End -->
            </div>
        </div>
    </div>
</div>
<!-- Careers Section End -->

<!-- Apply Section Start -->
<div class="apply-section bg-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto" id="apply-form">
                <!-- Section Title Start -->
                <div class="section-title section-title-center mb-5">
                    <span class="section-sub-title wow fadeInUp">Application</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">Submit Your Application</h2>
                </div>
                <!-- Section Title End -->

                <!-- Career Form Start -->
                <form action="{{ route('careers.submit') }}" method="POST" enctype="multipart/form-data" class="wow fadeInUp">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6 mb-4">
                            <label>Full Name *</label>
                            <input type="text" name="full_name" class="form-control" placeholder="Your Full Name" required>
                            @error('full_name')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-6 mb-4">
                            <label>Email Address *</label>
                            <input type="email" name="email" class="form-control" placeholder="your@email.com" required>
                            @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-6 mb-4">
                            <label>Phone Number *</label>
                            <input type="text" name="phone" class="form-control" placeholder="Your Phone Number" required>
                            @error('phone')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-6 mb-4">
                            <label>Position Applying For *</label>
                            <select name="position" class="form-control" required>
                                <option value="">-- Select Position --</option>
                                <option value="Site Engineer">Site Engineer</option>
                                <option value="Project Manager">Project Manager</option>
                                <option value="CAD Draftsman">CAD Draftsman</option>
                                <option value="Safety Officer">Safety Officer</option>
                            </select>
                            @error('position')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-12 mb-4">
                            <label>Experience (Years) *</label>
                            <input type="number" name="experience_years" class="form-control" placeholder="Years of Experience" required>
                            @error('experience_years')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-12 mb-4">
                            <label>Cover Letter *</label>
                            <textarea name="cover_letter" class="form-control" rows="5" placeholder="Tell us about yourself..." required></textarea>
                            @error('cover_letter')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-12 mb-4">
                            <label>Upload Resume (PDF) *</label>
                            <input type="file" name="resume" class="form-control" accept=".pdf" required>
                            @error('resume')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn-default">Submit Application</button>
                            @if(session('success'))
                                <div class="alert alert-success mt-3">{{ session('success') }}</div>
                            @endif
                        </div>
                    </div>
                </form>
                <!-- Career Form End -->
            </div>
        </div>
    </div>
</div>
<!-- Apply Section End -->

<style>
.benefits-list {
    list-style: none;
    padding: 0;
}
.benefits-list li {
    padding: 8px 0;
    display: flex;
    align-items: center;
}
.benefits-list i {
    margin-right: 10px;
    color: var(--primary-color);
}
.position-card {
    border: 1px solid #e0e0e0;
    padding: 20px;
    border-radius: 8px;
    transition: all 0.3s ease;
}
.position-card:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-color: var(--primary-color);
}
.position-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}
.position-header h4 {
    margin: 0;
    color: #333;
}
.position-meta {
    color: #666;
    font-size: 14px;
    margin-bottom: 10px;
}
.badge {
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
}
.badge-primary {
    background-color: var(--primary-color);
    color: white;
}
.badge-success {
    background-color: #28a745;
    color: white;
}
.badge-danger {
    background-color: #dc3545;
    color: white;
}
.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
    text-decoration: none;
    display: inline-block;
}
.btn-primary:hover {
    background-color: darken(var(--primary-color), 10%);
}
</style>

@endsection
