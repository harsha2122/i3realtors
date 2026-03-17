@extends('layouts.website')
@section('title', 'Careers - ' . ($site['site_name'] ?? config('app.name')))
@section('content')

<!-- Page Header Start -->
<div class="page-header bg-section parallaxie" style="background-image: url({{ asset('images/page-header-bg.jpg') }}); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center 9px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque">Careers</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Careers</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Career Intro Section Start -->
<div class="about-us">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-xl-7">
                <div class="section-title">
                    <span class="section-sub-title wow fadeInUp">Ready to Join i3 Realtors?</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">Apply to Join <span>Our Team</span></h2>
                </div>
            </div>
            <div class="col-xl-5">
                <div class="section-content-btn">
                    <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                        <p>We are always looking for talented professionals in sales, marketing, and real estate consulting. Submit your application and our team will get in touch if your profile matches our requirements.</p>
                    </div>
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.4s">
                        <a href="#apply-form" class="btn-default">Apply Now</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="about-us-image-box wow fadeInUp">
                    <div class="about-us-image">
                        <figure class="image-anime">
                            <img src="{{ asset('images/careers-image.jpg') }}" alt="Careers at i3 Realtors">
                        </figure>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="about-us-content-box wow fadeInUp" data-wow-delay="0.2s">
                    <div class="about-us-item-list">
                        <div class="about-us-item box-1">
                            <div class="about-us-item-content">
                                <h3>Grow With Industry Experts</h3>
                                <p>Work alongside experienced real estate professionals and gain exposure to developer mandates, project marketing, and strategic investment advisory.</p>
                            </div>
                        </div>
                        <div class="about-us-item box-2">
                            <div class="about-us-item-content">
                                <h3>Real Opportunities, Real Impact</h3>
                                <p>At i3 Realtors, every team member plays a role in delivering value for developers and investors — with clear growth paths and performance-driven recognition.</p>
                            </div>
                        </div>
                    </div>

                    <div class="about-counter-item-list">
                        <div class="about-counter-item">
                            <h2><span class="counter">25</span>+</h2>
                            <p>Developer Partners</p>
                        </div>
                        <div class="about-counter-item">
                            <h2><span class="counter">50</span>+</h2>
                            <p>Projects Handled</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Career Intro Section End -->

<!-- Open Positions Section Start -->
<div class="open-positions bg-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section-title text-center mb-5">
                    <span class="section-sub-title wow fadeInUp">What We're Looking For</span>
                    <h2 class="text-anime-style-2 mb-4" data-cursor="-opaque">Open Departments & Roles</h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">We are hiring across multiple departments. Explore the roles we are currently recruiting for.</p>
                </div>

                <div class="filter-controls text-center mb-5 wow fadeInUp" data-wow-delay="0.3s">
                    <button class="filter-btn active" data-filter="all">All Roles</button>
                    <button class="filter-btn" data-filter="sales">Sales</button>
                    <button class="filter-btn" data-filter="marketing">Marketing</button>
                    <button class="filter-btn" data-filter="operations">Operations</button>
                </div>
            </div>
        </div>

        <div class="row" id="positions-container">

            <div class="col-lg-6 position-card-wrapper mb-4" data-category="sales full-time">
                <div class="position-card wow fadeInUp">
                    <div class="position-header">
                        <div class="position-badge">Full-Time</div>
                        <div class="position-location"><i class="fas fa-map-marker-alt"></i> Pune</div>
                    </div>
                    <h3 class="position-title">Sales Executive</h3>
                    <div class="position-meta">
                        <span class="meta-item"><i class="fas fa-briefcase"></i> 1–3 Years</span>
                        <span class="meta-item"><i class="fas fa-money-bill"></i> Competitive</span>
                    </div>
                    <p class="position-description">Drive project sales through direct client engagement, investor outreach, and developer mandate presentations.</p>
                    <div class="position-details">
                        <div class="detail-item">
                            <strong>Key Responsibilities:</strong>
                            <ul>
                                <li>Client acquisition and relationship management</li>
                                <li>Investor presentations and site visits</li>
                                <li>Pipeline management and deal closures</li>
                            </ul>
                        </div>
                        <div class="detail-item">
                            <strong>Requirements:</strong>
                            <ul>
                                <li>1–3 years in real estate sales</li>
                                <li>Strong communication and negotiation skills</li>
                                <li>Knowledge of Pune real estate market</li>
                            </ul>
                        </div>
                    </div>
                    <a href="#apply-form" class="btn-default btn-sm">Apply Now</a>
                </div>
            </div>

            <div class="col-lg-6 position-card-wrapper mb-4" data-category="marketing full-time">
                <div class="position-card wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-header">
                        <div class="position-badge">Full-Time</div>
                        <div class="position-location"><i class="fas fa-map-marker-alt"></i> Pune</div>
                    </div>
                    <h3 class="position-title">Marketing Executive</h3>
                    <div class="position-meta">
                        <span class="meta-item"><i class="fas fa-briefcase"></i> 1–3 Years</span>
                        <span class="meta-item"><i class="fas fa-money-bill"></i> Competitive</span>
                    </div>
                    <p class="position-description">Plan and execute digital and offline marketing campaigns for real estate projects under developer mandate partnerships.</p>
                    <div class="position-details">
                        <div class="detail-item">
                            <strong>Key Responsibilities:</strong>
                            <ul>
                                <li>Project marketing strategy and execution</li>
                                <li>Digital campaigns, social media, and lead generation</li>
                                <li>Brand positioning and content creation</li>
                            </ul>
                        </div>
                        <div class="detail-item">
                            <strong>Requirements:</strong>
                            <ul>
                                <li>1–3 years in real estate or digital marketing</li>
                                <li>Proficiency in social media and Google Ads</li>
                                <li>Creative thinking and analytical mindset</li>
                            </ul>
                        </div>
                    </div>
                    <a href="#apply-form" class="btn-default btn-sm">Apply Now</a>
                </div>
            </div>

            <div class="col-lg-6 position-card-wrapper mb-4" data-category="sales full-time">
                <div class="position-card wow fadeInUp" data-wow-delay="0.2s">
                    <div class="position-header">
                        <div class="position-badge">Full-Time</div>
                        <div class="position-location"><i class="fas fa-map-marker-alt"></i> Pune</div>
                    </div>
                    <h3 class="position-title">Pre-Sales Executive</h3>
                    <div class="position-meta">
                        <span class="meta-item"><i class="fas fa-briefcase"></i> 0–2 Years</span>
                        <span class="meta-item"><i class="fas fa-money-bill"></i> Competitive</span>
                    </div>
                    <p class="position-description">Qualify leads, handle initial client inquiries, and support the sales team with project information and client coordination.</p>
                    <div class="position-details">
                        <div class="detail-item">
                            <strong>Key Responsibilities:</strong>
                            <ul>
                                <li>Lead qualification and follow-up</li>
                                <li>Client communication and CRM management</li>
                                <li>Supporting sales team with project briefs</li>
                            </ul>
                        </div>
                        <div class="detail-item">
                            <strong>Requirements:</strong>
                            <ul>
                                <li>Good communication skills in English and Hindi</li>
                                <li>Comfortable with CRM tools and Excel</li>
                                <li>Freshers with real estate interest welcome</li>
                            </ul>
                        </div>
                    </div>
                    <a href="#apply-form" class="btn-default btn-sm">Apply Now</a>
                </div>
            </div>

            <div class="col-lg-6 position-card-wrapper mb-4" data-category="operations full-time">
                <div class="position-card wow fadeInUp" data-wow-delay="0.3s">
                    <div class="position-header">
                        <div class="position-badge">Full-Time</div>
                        <div class="position-location"><i class="fas fa-map-marker-alt"></i> Pune</div>
                    </div>
                    <h3 class="position-title">Admin & Operations</h3>
                    <div class="position-meta">
                        <span class="meta-item"><i class="fas fa-briefcase"></i> 1–3 Years</span>
                        <span class="meta-item"><i class="fas fa-money-bill"></i> Competitive</span>
                    </div>
                    <p class="position-description">Support day-to-day office operations, HR coordination, accounts, MIS reporting, and CRM management for the team.</p>
                    <div class="position-details">
                        <div class="detail-item">
                            <strong>Key Responsibilities:</strong>
                            <ul>
                                <li>Office administration and HR support</li>
                                <li>Accounts, MIS, and reporting</li>
                                <li>CRM data management and coordination</li>
                            </ul>
                        </div>
                        <div class="detail-item">
                            <strong>Requirements:</strong>
                            <ul>
                                <li>1–3 years in admin / back-office role</li>
                                <li>Proficiency in Excel and CRM tools</li>
                                <li>Organised, detail-oriented, and proactive</li>
                            </ul>
                        </div>
                    </div>
                    <a href="#apply-form" class="btn-default btn-sm">Apply Now</a>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Open Positions Section End -->

<!-- Application Form Start -->
<div class="our-history" id="apply-form">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 mb-5">
                <div class="section-title text-center">
                    <span class="section-sub-title wow fadeInUp">Ready to Join i3 Realtors?</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">Apply to Join Our Team</h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">We are always looking for talented professionals in sales, marketing, and real estate consulting. Submit your application and our team will get in touch if your profile matches our requirements.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 mx-auto">
                <form action="{{ route('careers.submit') }}" method="POST" enctype="multipart/form-data" class="career-form wow fadeInUp" data-wow-delay="0.2s">
                    @csrf
                    <div class="row">

                        <div class="form-group col-md-6 mb-4">
                            <label class="form-label fw-semibold">Full Name *</label>
                            <input type="text" name="full_name" class="form-control form-control-lg" placeholder="Your Full Name" value="{{ old('full_name') }}" required>
                            @error('full_name')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-6 mb-4">
                            <label class="form-label fw-semibold">Email Address *</label>
                            <input type="email" name="email" class="form-control form-control-lg" placeholder="your@email.com" value="{{ old('email') }}" required>
                            @error('email')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-6 mb-4">
                            <label class="form-label fw-semibold">Phone Number *</label>
                            <input type="text" name="phone" class="form-control form-control-lg" placeholder="Your Phone Number" value="{{ old('phone') }}" required>
                            @error('phone')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-6 mb-4">
                            <label class="form-label fw-semibold">Department / Job Category *</label>
                            <select name="position" class="form-control form-control-lg" required>
                                <option value="">-- Select Department --</option>
                                <option value="Sales" {{ old('position') === 'Sales' ? 'selected' : '' }}>Sales</option>
                                <option value="Marketing" {{ old('position') === 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                <option value="Pre-Sales" {{ old('position') === 'Pre-Sales' ? 'selected' : '' }}>Pre-Sales</option>
                                <option value="Admin & HR" {{ old('position') === 'Admin & HR' ? 'selected' : '' }}>Admin & HR</option>
                                <option value="Accounts & MIS" {{ old('position') === 'Accounts & MIS' ? 'selected' : '' }}>Accounts & MIS</option>
                                <option value="CRM" {{ old('position') === 'CRM' ? 'selected' : '' }}>CRM</option>
                            </select>
                            @error('position')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-6 mb-4">
                            <label class="form-label fw-semibold">Years of Experience *</label>
                            <input type="number" name="experience_years" class="form-control form-control-lg" placeholder="Years" min="0" max="50" value="{{ old('experience_years') }}" required>
                            @error('experience_years')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-6 mb-4">
                            <label class="form-label fw-semibold">Preferred Location</label>
                            <select name="preferred_location" class="form-control form-control-lg">
                                <option value="">-- Select Location --</option>
                                <option value="Pune" {{ old('preferred_location') === 'Pune' ? 'selected' : '' }}>Pune</option>
                                <option value="Remote / Flexible" {{ old('preferred_location') === 'Remote / Flexible' ? 'selected' : '' }}>Remote / Flexible</option>
                            </select>
                            @error('preferred_location')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-12 mb-4">
                            <label class="form-label fw-semibold">Cover Letter *</label>
                            <textarea name="cover_letter" class="form-control form-control-lg" rows="5" placeholder="Briefly tell us about your experience and why you would like to join i3 Realtors." required>{{ old('cover_letter') }}</textarea>
                            @error('cover_letter')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-12 mb-4">
                            <label class="form-label fw-semibold">Upload Resume / CV (PDF) *</label>
                            <div class="file-input-wrapper">
                                <input type="file" name="resume" id="resume" class="form-control form-control-lg" accept=".pdf" required>
                                <small class="text-muted d-block mt-2">Maximum file size: 5MB</small>
                            </div>
                            @error('resume')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn-default w-100">Submit Application</button>
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
.filter-btn:hover, .filter-btn.active {
    background: var(--primary-color);
    color: white;
}
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
    border-color: var(--accent-secondary-color);
    box-shadow: 0 10px 30px rgba(200, 169, 106, 0.15);
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
.position-location i { color: var(--accent-secondary-color); }
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
.meta-item i { color: var(--accent-secondary-color); }
.position-description {
    font-size: 15px;
    color: #555;
    line-height: 1.6;
    margin-bottom: 20px;
}
.position-details { flex-grow: 1; margin-bottom: 20px; }
.detail-item { margin-bottom: 18px; }
.detail-item strong {
    display: block;
    font-size: 14px;
    color: #1a1a1a;
    margin-bottom: 8px;
    font-weight: 600;
}
.detail-item ul { list-style: none; padding: 0; margin: 0; }
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
    color: var(--accent-secondary-color);
    font-weight: bold;
}
.position-card-wrapper { opacity: 1; transition: all 0.3s ease; }
.position-card-wrapper.hidden { opacity: 0; display: none; }
.btn-sm { padding: 12px 24px !important; font-size: 14px !important; }
.form-control-lg {
    height: 48px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    font-size: 15px;
    transition: all 0.3s ease;
}
.form-control-lg:focus {
    border-color: var(--accent-secondary-color);
    box-shadow: 0 0 0 3px rgba(200, 169, 106, 0.15);
}
textarea.form-control-lg { height: auto; }
.form-label { font-size: 14px; color: #333; margin-bottom: 10px; }
.file-input-wrapper input[type="file"] { padding: 12px; }
.career-form .btn-default { width: 100%; padding: 15px 40px; }
@media (max-width: 768px) {
    .form-control-lg { height: 44px; font-size: 14px; }
    .filter-controls { gap: 10px; }
    .filter-btn { padding: 8px 18px; font-size: 12px; }
    .position-details { display: none; }
    .position-card { padding: 20px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const positionCards = document.querySelectorAll('.position-card-wrapper');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const filter = this.getAttribute('data-filter');
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            positionCards.forEach(card => {
                const cats = card.getAttribute('data-category').split(' ');
                if (filter === 'all' || cats.includes(filter)) {
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
