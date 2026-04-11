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


<!-- Open Positions Section Start -->
<div class="open-positions bg-section" style="padding-top: 80px;">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section-title text-center mb-5">
                    <span class="section-sub-title wow fadeInUp">What We're Looking For</span>
                    <h2 class="text-anime-style-2 mb-4" data-cursor="-opaque">Open Departments & Roles</h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">We are hiring across multiple departments. Explore the roles we are currently recruiting for.</p>
                </div>

                @if($jobs->isNotEmpty())
                @php $categories = $jobs->pluck('category')->unique()->filter()->values(); @endphp
                <div class="filter-controls text-center mb-5 wow fadeInUp" data-wow-delay="0.3s">
                    <button class="filter-btn active" data-filter="all">All Roles</button>
                    @foreach($categories as $cat)
                        <button class="filter-btn" data-filter="{{ $cat }}">{{ ucfirst($cat) }}</button>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        <div class="row" id="positions-container">
            @forelse($jobs as $i => $job)
            <div class="col-lg-6 position-card-wrapper mb-4" data-category="{{ $job->category }} {{ strtolower(str_replace(' ','-',$job->employment_type)) }}">
                <div class="position-card wow fadeInUp" data-wow-delay="{{ number_format($i * 0.1, 1) }}s">
                    <div class="position-header">
                        <div class="position-badge">{{ $job->employment_type }}</div>
                        <div class="position-location"><i class="fas fa-map-marker-alt"></i> {{ $job->location }}</div>
                    </div>
                    <h3 class="position-title">{{ $job->title }}</h3>
                    <div class="position-meta">
                        @if($job->experience)
                        <span class="meta-item"><i class="fas fa-briefcase"></i> {{ $job->experience }}</span>
                        @endif
                    </div>
                    @if($job->description)
                    <p class="position-description">{{ $job->description }}</p>
                    @endif
                    <div class="position-details">
                        @if(!empty($job->responsibilities))
                        <div class="detail-item">
                            <strong>Key Responsibilities:</strong>
                            <ul>
                                @foreach($job->responsibilities as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if(!empty($job->requirements))
                        <div class="detail-item">
                            <strong>Requirements:</strong>
                            <ul>
                                @foreach($job->requirements as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    <a href="#apply-form" class="btn-default btn-sm apply-now-btn"
                       data-job-id="{{ $job->id }}"
                       data-job-title="{{ $job->title }}">Apply Now</a>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-5">
                <p>No open positions at the moment. Check back soon!</p>
            </div>
            @endforelse
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
                    <h2 class="text-anime-style-2" data-cursor="-opaque">Apply for This Position</h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">Fill in the details below and upload your resume. We will get back to you if your profile matches our requirements.</p>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="alert alert-success text-center py-4" role="alert">
                        <i class="fas fa-check-circle fa-2x mb-2 d-block"></i>
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-xl-8 mx-auto">
                <form action="{{ route('careers.submit') }}" method="POST" enctype="multipart/form-data" class="career-form wow fadeInUp" data-wow-delay="0.2s">
                    @csrf
                    <input type="hidden" name="career_job_id" id="form-job-id" value="">
                    <input type="hidden" name="job_title" id="form-job-title" value="General Application">

                    <div class="applying-for-label mb-4 p-3 rounded" style="background:#f8f5f0;border-left:4px solid var(--primary-color,#e05a00);">
                        <small class="text-muted">Applying for:</small>
                        <div class="fw-semibold" id="applying-for-display">General Application</div>
                    </div>

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
                            <label class="form-label fw-semibold">Years of Experience *</label>
                            <input type="number" name="experience_years" class="form-control form-control-lg" placeholder="e.g. 2" min="0" max="50" value="{{ old('experience_years') }}" required>
                            @error('experience_years')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-12 mb-4">
                            <label class="form-label fw-semibold">Cover Letter (optional)</label>
                            <textarea name="cover_letter" class="form-control form-control-lg" rows="4" placeholder="Briefly tell us about yourself and why you want to join i3 Realtors.">{{ old('cover_letter') }}</textarea>
                        </div>

                        <div class="form-group col-md-12 mb-4">
                            <label class="form-label fw-semibold">Upload Resume / CV (PDF) *</label>
                            <input type="file" name="resume" class="form-control form-control-lg" accept=".pdf" required>
                            <small class="text-muted d-block mt-2">PDF only · Max 5MB</small>
                            @error('resume')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn-default w-100">Submit Application</button>
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
    // Filter buttons
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

    // Apply Now buttons — populate form with job details
    document.querySelectorAll('.apply-now-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            const jobId    = this.getAttribute('data-job-id');
            const jobTitle = this.getAttribute('data-job-title');
            document.getElementById('form-job-id').value        = jobId;
            document.getElementById('form-job-title').value     = jobTitle;
            document.getElementById('applying-for-display').textContent = jobTitle;
        });
    });
});
</script>

@endsection
