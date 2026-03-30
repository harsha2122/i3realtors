@extends('layouts.website')
@section('title', 'Fund Raising - ' . ($site['site_name'] ?? config('app.name')))
@section('content')

<!-- Page Header Start -->
@php $breadcrumbBg = \App\Models\Setting::get('breadcrumb_bg'); @endphp
<div class="page-header bg-section parallaxie" style="background-image: url({{ $breadcrumbBg ? asset('uploads/' . $breadcrumbBg) : asset('images/page-header-bg.jpg') }}); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center 9px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque">Fund Raising</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('services') }}">Services</a></li>
                            <li class="breadcrumb-item active">Fund Raising</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Intro Section Start -->
<div style="padding: 80px 0; background: #ffffff;">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-xl-6">
                <div class="section-title">
                    <span class="section-sub-title wow fadeInUp">Our Expertise</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">Strategic <span>Fund Raising</span> for Real Estate</h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s" style="color:#555; line-height:1.8;">
                        i3 Realtors brings a structured and relationship-driven approach to real estate fund raising. We bridge developers and investors with the right capital partners — from private equity firms to institutional lenders and high-net-worth investors.
                    </p>
                    <p class="wow fadeInUp" data-wow-delay="0.3s" style="color:#555; line-height:1.8;">
                        Our network and expertise ensure that capital is raised efficiently, with the right structuring and partnerships to support every stage of your project.
                    </p>
                </div>

                <!-- Two Key Points Start -->
                <div class="wow fadeInUp" data-wow-delay="0.4s" style="margin-top: 32px;">
                    <div style="display:flex; flex-direction:column; gap:16px;">
                        <div style="display:flex; align-items:flex-start; gap:16px; padding:20px 24px; background:#f9f7f2; border-left:4px solid var(--accent-secondary-color); border-radius:0 8px 8px 0;">
                            <div style="width:40px; height:40px; background: var(--accent-secondary-color); border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:2px;">
                                <i class="fas fa-landmark" style="color:#fff; font-size:16px;"></i>
                            </div>
                            <div>
                                <h4 style="font-size:16px; font-weight:700; color:#111; margin:0 0 4px;">Fund Raising from Private Equity, Banks & Financial Institutions</h4>
                                <p style="font-size:14px; color:#666; margin:0; line-height:1.6;">Structured capital from PE funds, NBFCs, banks, and financial institutions for real estate projects.</p>
                            </div>
                        </div>
                        <div style="display:flex; align-items:flex-start; gap:16px; padding:20px 24px; background:#f9f7f2; border-left:4px solid var(--accent-secondary-color); border-radius:0 8px 8px 0;">
                            <div style="width:40px; height:40px; background: var(--accent-secondary-color); border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:2px;">
                                <i class="fas fa-users" style="color:#fff; font-size:16px;"></i>
                            </div>
                            <div>
                                <h4 style="font-size:16px; font-weight:700; color:#111; margin:0 0 4px;">Fund Raising from Investors</h4>
                                <p style="font-size:14px; color:#666; margin:0; line-height:1.6;">HNI and institutional investor outreach to connect capital with the right real estate opportunities.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Two Key Points End -->
            </div>

            <div class="col-xl-6">
                <div class="about-us-image-box wow fadeInUp" data-wow-delay="0.2s">
                    <div class="about-us-image">
                        <figure class="image-anime">
                            @php $aboutMainImg = \App\Models\Setting::get('about_main_image'); @endphp
                            <img src="{{ $aboutMainImg ? asset('uploads/' . $aboutMainImg) : asset('images/who-we-are-image-1.jpeg') }}" alt="Fund Raising" style="border-radius:12px;" />
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Intro Section End -->

<!-- What We Provide Section Start -->
<div style="padding: 80px 0; background: #f9f7f2;">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <div class="section-title section-title-center">
                    <span class="section-sub-title wow fadeInUp">Our Capabilities</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">What We <span>Provide</span></h2>
                </div>
            </div>
        </div>

        <div class="row g-4 wow fadeInUp" data-wow-delay="0.2s">
            <!-- Card 1 -->
            <div class="col-lg-4 col-md-6">
                <div style="background:#ffffff; border-radius:12px; padding:40px 32px; height:100%; border-bottom:3px solid transparent; transition:border-color 0.3s, box-shadow 0.3s; box-shadow:0 2px 16px rgba(0,0,0,0.06);"
                     onmouseover="this.style.borderColor='var(--accent-secondary-color)'; this.style.boxShadow='0 8px 32px rgba(0,0,0,0.12)';"
                     onmouseout="this.style.borderColor='transparent'; this.style.boxShadow='0 2px 16px rgba(0,0,0,0.06)';">
                    <div style="width:64px; height:64px; background:rgba(184,150,43,0.1); border-radius:12px; display:flex; align-items:center; justify-content:center; margin-bottom:24px;">
                        <i class="fas fa-university" style="font-size:28px; color: var(--accent-secondary-color);"></i>
                    </div>
                    <h3 style="font-size:20px; font-weight:700; color:#111; margin-bottom:12px;">Private Equity & Financial Institutions</h3>
                    <p style="color:#666; font-size:15px; line-height:1.7; margin:0;">We connect developers with private equity firms, NBFCs, banks, and financial institutions to secure structured funding tailored to each project's needs and timeline.</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-lg-4 col-md-6">
                <div style="background:#ffffff; border-radius:12px; padding:40px 32px; height:100%; border-bottom:3px solid transparent; transition:border-color 0.3s, box-shadow 0.3s; box-shadow:0 2px 16px rgba(0,0,0,0.06);"
                     onmouseover="this.style.borderColor='var(--accent-secondary-color)'; this.style.boxShadow='0 8px 32px rgba(0,0,0,0.12)';"
                     onmouseout="this.style.borderColor='transparent'; this.style.boxShadow='0 2px 16px rgba(0,0,0,0.06)';">
                    <div style="width:64px; height:64px; background:rgba(184,150,43,0.1); border-radius:12px; display:flex; align-items:center; justify-content:center; margin-bottom:24px;">
                        <i class="fas fa-hand-holding-usd" style="font-size:28px; color: var(--accent-secondary-color);"></i>
                    </div>
                    <h3 style="font-size:20px; font-weight:700; color:#111; margin-bottom:12px;">Investor Fund Raising</h3>
                    <p style="color:#666; font-size:15px; line-height:1.7; margin:0;">Through our curated network of HNIs and institutional investors, we facilitate targeted investor outreach and connect the right capital with the right real estate opportunity.</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-lg-4 col-md-6">
                <div style="background:#ffffff; border-radius:12px; padding:40px 32px; height:100%; border-bottom:3px solid transparent; transition:border-color 0.3s, box-shadow 0.3s; box-shadow:0 2px 16px rgba(0,0,0,0.06);"
                     onmouseover="this.style.borderColor='var(--accent-secondary-color)'; this.style.boxShadow='0 8px 32px rgba(0,0,0,0.12)';"
                     onmouseout="this.style.borderColor='transparent'; this.style.boxShadow='0 2px 16px rgba(0,0,0,0.06)';">
                    <div style="width:64px; height:64px; background:rgba(184,150,43,0.1); border-radius:12px; display:flex; align-items:center; justify-content:center; margin-bottom:24px;">
                        <i class="fas fa-file-contract" style="font-size:28px; color: var(--accent-secondary-color);"></i>
                    </div>
                    <h3 style="font-size:20px; font-weight:700; color:#111; margin-bottom:12px;">Financial Structuring & Advisory</h3>
                    <p style="color:#666; font-size:15px; line-height:1.7; margin:0;">We assist in deal structuring, documentation, and due diligence to ensure fund raising is smooth, legally compliant, and optimally structured for all stakeholders.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- What We Provide Section End -->

<!-- Our Clientele Section Start -->
<div style="padding: 80px 0; background: #ffffff;">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <div class="section-title section-title-center">
                    <span class="section-sub-title wow fadeInUp">Trusted Partners</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">Our <span>Clientele</span></h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s" style="color:#666; max-width:600px; margin:0 auto;">
                        We work with leading banks, financial institutions, and investment firms across the country.
                    </p>
                </div>
            </div>
        </div>

        @if($logos->isNotEmpty())
        <div class="row g-3 wow fadeInUp" data-wow-delay="0.2s" style="margin-top:20px;">
            @foreach($logos as $logo)
            <div class="col-lg-3 col-md-4 col-6">
                <div style="border:1px solid #e5e5e5; border-radius:8px; background:#fff; aspect-ratio:1/1; display:flex; align-items:center; justify-content:center; padding:20px; transition:box-shadow 0.3s, border-color 0.3s;"
                     onmouseover="this.style.boxShadow='0 4px 20px rgba(0,0,0,0.1)'; this.style.borderColor='var(--accent-secondary-color)';"
                     onmouseout="this.style.boxShadow='none'; this.style.borderColor='#e5e5e5';">
                    <img src="{{ asset('uploads/' . $logo->logo) }}" alt="Partner"
                         style="max-width:100%; max-height:100%; object-fit:contain;">
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.2s" style="margin-top:20px;">
            <div class="col-lg-6 text-center">
                <p style="color:#aaa; font-size:15px;">Clientele logos coming soon.</p>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Our Clientele Section End -->

<!-- CTA Section Start -->
<div class="cta-box bg-section dark-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 text-center">
                <div class="section-title section-title-center">
                    <span class="section-sub-title wow fadeInUp">Get Started</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">
                        Ready to <span>Raise Capital</span> for Your Project?
                    </h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">Connect with our fund raising experts to explore the right capital strategy for your real estate project.</p>
                </div>
                <div class="wow fadeInUp" data-wow-delay="0.4s">
                    <a href="{{ route('contact') }}" class="btn-default btn-highlighted me-3">Connect With Us</a>
                    <a href="{{ route('website.projects.index') }}" class="btn-default">Explore Projects</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CTA Section End -->

@endsection
