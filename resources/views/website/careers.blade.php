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
<div class="open-positions bg-section">
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

                <!-- Filter Controls Start -->
                <div class="filter-controls text-center mb-5 wow fadeInUp" data-wow-delay="0.3s">
                    <button class="filter-btn active" data-filter="all">All Positions</button>
                    <button class="filter-btn" data-filter="on-site">On-Site</button>
                    <button class="filter-btn" data-filter="office">Office</button>
                    <button class="filter-btn" data-filter="full-time">Full-Time</button>
                </div>
                <!-- Filter Controls End -->
            </div>
        </div>

        <div class="row" id="positions-container">
            <!-- Position Card Start -->
            <div class="col-lg-6 position-card-wrapper mb-4" data-category="on-site full-time">
                <div class="position-card wow fadeInUp">
                    <div class="position-header">
                        <div class="position-badge">Full-Time</div>
                        <div class="position-location">
                            <i class="fas fa-map-marker-alt"></i> On-Site
                        </div>
                    </div>
                    <h3 class="position-title">Site Engineer</h3>
                    <div class="position-meta">
                        <span class="meta-item"><i class="fas fa-briefcase"></i> 3-5 Years</span>
                        <span class="meta-item"><i class="fas fa-money-bill"></i> Competitive</span>
                    </div>
                    <p class="position-description">Oversee construction projects, ensure quality standards, and lead site teams with precision and excellence.</p>

                    <div class="position-details">
                        <div class="detail-item">
                            <strong>Responsibilities:</strong>
                            <ul>
                                <li>Manage daily site operations</li>
                                <li>Ensure safety compliance</li>
                                <li>Quality assurance oversight</li>
                            </ul>
                        </div>
                        <div class="detail-item">
                            <strong>Requirements:</strong>
                            <ul>
                                <li>3-5 years experience</li>
                                <li>Civil engineering degree</li>
                                <li>Strong leadership skills</li>
                            </ul>
                        </div>
                        <div class="detail-item">
                            <strong>Benefits:</strong>
                            <ul>
                                <li>Health insurance</li>
                                <li>Professional development</li>
                                <li>Competitive salary</li>
                            </ul>
                        </div>
                    </div>

                    <a href="#apply-form" class="btn-default btn-sm">Apply Now</a>
                </div>
            </div>
            <!-- Position Card End -->

            <!-- Position Card Start -->
            <div class="col-lg-6 position-card-wrapper mb-4" data-category="office full-time">
                <div class="position-card wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-header">
                        <div class="position-badge">Full-Time</div>
                        <div class="position-location">
                            <i class="fas fa-map-marker-alt"></i> Office
                        </div>
                    </div>
                    <h3 class="position-title">Project Manager</h3>
                    <div class="position-meta">
                        <span class="meta-item"><i class="fas fa-briefcase"></i> 5+ Years</span>
                        <span class="meta-item"><i class="fas fa-money-bill"></i> Competitive</span>
                    </div>
                    <p class="position-description">Lead construction projects from conception to completion, managing budgets, timelines, and teams with excellence.</p>

                    <div class="position-details">
                        <div class="detail-item">
                            <strong>Responsibilities:</strong>
                            <ul>
                                <li>Project planning & execution</li>
                                <li>Budget management</li>
                                <li>Team coordination</li>
                            </ul>
                        </div>
                        <div class="detail-item">
                            <strong>Requirements:</strong>
                            <ul>
                                <li>5+ years experience</li>
                                <li>Project management cert.</li>
                                <li>Excellent communication</li>
                            </ul>
                        </div>
                        <div class="detail-item">
                            <strong>Benefits:</strong>
                            <ul>
                                <li>Health & dental insurance</li>
                                <li>Career growth path</li>
                                <li>Flexible hours</li>
                            </ul>
                        </div>
                    </div>

                    <a href="#apply-form" class="btn-default btn-sm">Apply Now</a>
                </div>
            </div>
            <!-- Position Card End -->

            <!-- Position Card Start -->
            <div class="col-lg-6 position-card-wrapper mb-4" data-category="office full-time">
                <div class="position-card wow fadeInUp" data-wow-delay="0.2s">
                    <div class="position-header">
                        <div class="position-badge">Full-Time</div>
                        <div class="position-location">
                            <i class="fas fa-map-marker-alt"></i> Office
                        </div>
                    </div>
                    <h3 class="position-title">CAD Draftsman</h3>
                    <div class="position-meta">
                        <span class="meta-item"><i class="fas fa-briefcase"></i> 2-3 Years</span>
                        <span class="meta-item"><i class="fas fa-money-bill"></i> Competitive</span>
                    </div>
                    <p class="position-description">Create detailed architectural and construction drawings using AutoCAD and design software to support our design team.</p>

                    <div class="position-details">
                        <div class="detail-item">
                            <strong>Responsibilities:</strong>
                            <ul>
                                <li>CAD drawings & models</li>
                                <li>Design documentation</li>
                                <li>Technical support</li>
                            </ul>
                        </div>
                        <div class="detail-item">
                            <strong>Requirements:</strong>
                            <ul>
                                <li>2-3 years CAD experience</li>
                                <li>AutoCAD proficiency</li>
                                <li>Technical drawing knowledge</li>
                            </ul>
                        </div>
                        <div class="detail-item">
                            <strong>Benefits:</strong>
                            <ul>
                                <li>Health insurance</li>
                                <li>Skill development programs</li>
                                <li>Competitive compensation</li>
                            </ul>
                        </div>
                    </div>

                    <a href="#apply-form" class="btn-default btn-sm">Apply Now</a>
                </div>
            </div>
            <!-- Position Card End -->

            <!-- Position Card Start -->
            <div class="col-lg-6 position-card-wrapper mb-4" data-category="on-site full-time">
                <div class="position-card wow fadeInUp" data-wow-delay="0.3s">
                    <div class="position-header">
                        <div class="position-badge">Full-Time</div>
                        <div class="position-location">
                            <i class="fas fa-map-marker-alt"></i> On-Site
                        </div>
                    </div>
                    <h3 class="position-title">Safety Officer</h3>
                    <div class="position-meta">
                        <span class="meta-item"><i class="fas fa-briefcase"></i> 3-5 Years</span>
                        <span class="meta-item"><i class="fas fa-money-bill"></i> Competitive</span>
                    </div>
                    <p class="position-description">Ensure workplace safety compliance and conduct regular audits to maintain high safety standards across all sites.</p>

                    <div class="position-details">
                        <div class="detail-item">
                            <strong>Responsibilities:</strong>
                            <ul>
                                <li>Safety audits & inspections</li>
                                <li>Compliance monitoring</li>
                                <li>Training & education</li>
                            </ul>
                        </div>
                        <div class="detail-item">
                            <strong>Requirements:</strong>
                            <ul>
                                <li>3-5 years experience</li>
                                <li>Safety certifications</li>
                                <li>Knowledge of OSHA standards</li>
                            </ul>
                        </div>
                        <div class="detail-item">
                            <strong>Benefits:</strong>
                            <ul>
                                <li>Comprehensive insurance</li>
                                <li>Certification support</li>
                                <li>Competitive salary</li>
                            </ul>
                        </div>
                    </div>

                    <a href="#apply-form" class="btn-default btn-sm">Apply Now</a>
                </div>
            </div>
            <!-- Position Card End -->
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
/* Filter Controls */
.filter-controls {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    justify-content: center;
}

.filter-btn {
    padding: 10px 24px;
    border: 2px solid var(--primary-color);
    background: transparent;
    color: var(--primary-color);
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
}

.filter-btn:hover,
.filter-btn.active {
    background: var(--primary-color);
    color: white;
}

/* Position Cards */
.position-card {
    background: white;
    border: 1px solid #e8e8e8;
    border-radius: 12px;
    padding: 30px;
    height: 100%;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.position-card:hover {
    border-color: var(--primary-color);
    box-shadow: 0 10px 30px rgba(184, 150, 43, 0.15);
    transform: translateY(-5px);
}

.position-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
    gap: 10px;
}

.position-badge {
    display: inline-block;
    padding: 6px 14px;
    background: var(--primary-color);
    color: white;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.position-location {
    font-size: 13px;
    color: #666;
    display: flex;
    align-items: center;
    gap: 5px;
}

.position-location i {
    color: var(--primary-color);
}

.position-title {
    font-size: 20px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 15px 0 10px 0;
}

.position-meta {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
    flex-wrap: wrap;
}

.meta-item {
    font-size: 13px;
    color: #666;
    display: flex;
    align-items: center;
    gap: 5px;
}

.meta-item i {
    color: var(--primary-color);
}

.position-description {
    font-size: 15px;
    color: #555;
    line-height: 1.6;
    margin-bottom: 20px;
}

.position-details {
    flex-grow: 1;
    margin-bottom: 20px;
}

.detail-item {
    margin-bottom: 18px;
}

.detail-item strong {
    display: block;
    font-size: 14px;
    color: #1a1a1a;
    margin-bottom: 8px;
    font-weight: 600;
}

.detail-item ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.detail-item li {
    font-size: 13px;
    color: #666;
    padding-left: 20px;
    margin-bottom: 5px;
    position: relative;
}

.detail-item li:before {
    content: "✓";
    position: absolute;
    left: 0;
    color: var(--primary-color);
    font-weight: bold;
}

.position-card-wrapper {
    opacity: 1;
    transition: all 0.3s ease;
}

.position-card-wrapper.hidden {
    opacity: 0;
    display: none;
}

.btn-sm {
    padding: 12px 24px !important;
    font-size: 14px !important;
}

/* Form Styles */
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

    .filter-controls {
        gap: 10px;
    }

    .filter-btn {
        padding: 8px 18px;
        font-size: 12px;
    }

    .position-details {
        display: none;
    }

    .position-card {
        padding: 20px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const positionCards = document.querySelectorAll('.position-card-wrapper');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');

            // Update active button
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // Filter cards
            positionCards.forEach(card => {
                const categories = card.getAttribute('data-category').split(' ');

                if (filter === 'all' || categories.includes(filter)) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
        });
    });
});
</script>

@endsection
