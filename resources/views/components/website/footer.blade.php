@php
    $logoWhite   = $site['logo_white'] ?? null;
    $siteName    = $site['site_name'] ?? config('app.name');
    $footerAbout = $site['footer_about'] ?? '';
    $footerCta   = $site['footer_cta_title'] ?? 'Build strategic real estate partnerships with trusted experts';
    $copyright   = $site['footer_copyright'] ?? ('Copyright &copy; ' . date('Y') . ' All Rights Reserved.');

    // Contact
    $phone1  = $site['phone_primary'] ?? '';
    $phone2  = $site['phone_secondary'] ?? '';
    $email   = $site['email_primary'] ?? '';
    $address = $site['address'] ?? '';

    // Social
    $socials = [
        'facebook'  => ['url' => $site['social_facebook']  ?? null, 'icon' => 'fa-brands fa-facebook-f'],
        'twitter'   => ['url' => $site['social_twitter']   ?? null, 'icon' => 'fa-brands fa-x-twitter'],
        'instagram' => ['url' => $site['social_instagram'] ?? null, 'icon' => 'fa-brands fa-instagram'],
        'linkedin'  => ['url' => $site['social_linkedin']  ?? null, 'icon' => 'fa-brands fa-linkedin-in'],
        'youtube'   => ['url' => $site['social_youtube']   ?? null, 'icon' => 'fa-brands fa-youtube'],
        'pinterest' => ['url' => $site['social_pinterest'] ?? null, 'icon' => 'fa-brands fa-pinterest-p'],
    ];
@endphp

<!-- Main Footer Start -->
<footer class="main-footer bg-section dark-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Footer Header Start -->
                <div class="footer-header">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h2 class="text-anime-style-2" data-cursor="-opaque">
                            {!! $footerCta !!}
                        </h2>
                    </div>
                    <!-- Section Title End -->

                    <!-- Footer Social Links Start -->
                    <div class="footer-social-links">
                        <h3>Explore Our Social Media</h3>
                        <ul>
                            @foreach($socials as $platform => $social)
                                @if($social['url'])
                                <li>
                                    <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"
                                       aria-label="{{ ucfirst($platform) }}">
                                        <i class="{{ $social['icon'] }}"></i>
                                    </a>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <!-- Footer Social Links End -->
                </div>
                <!-- Footer Header End -->
            </div>

            <div class="col-xl-4">
                <!-- About Footer Start -->
                <div class="about-footer">
                    <div class="footer-logo">
                        @if($logoWhite)
                            <img src="{{ $logoWhite }}" alt="{{ $siteName }}" style="max-height: 60px; width: auto; object-fit: contain;" />
                        @else
                            <img src="{{ asset('images/logo-white.svg') }}" alt="{{ $siteName }}" style="max-height: 60px; width: auto; object-fit: contain;" />
                        @endif
                    </div>
                    <div class="about-footer-content">
                        <p>{{ $footerAbout ?: 'i3 Realtors is a mandate-focused real estate consulting firm connecting developers and investors through strategic project marketing, structured partnerships, and market-driven real estate opportunities.' }}</p>
                    </div>

                    @if($phone1 || $email || $address)
                    <div class="about-footer-contact mt-3" style="font-size: 0.9rem;">
                        @if($phone1)
                        <div class="mb-1">
                            <i class="fas fa-phone-alt me-2" style="color: var(--primary-color)"></i>
                            <a href="tel:{{ $phone1 }}" style="color: rgba(255,255,255,0.75); text-decoration: none;">{{ $phone1 }}</a>
                        </div>
                        @endif
                        @if($phone2)
                        <div class="mb-1">
                            <i class="fas fa-phone-alt me-2" style="color: var(--primary-color)"></i>
                            <a href="tel:{{ $phone2 }}" style="color: rgba(255,255,255,0.75); text-decoration: none;">{{ $phone2 }}</a>
                        </div>
                        @endif
                        @if($email)
                        <div class="mb-1">
                            <i class="fas fa-envelope me-2" style="color: var(--primary-color)"></i>
                            <a href="mailto:{{ $email }}" style="color: rgba(255,255,255,0.75); text-decoration: none;">{{ $email }}</a>
                        </div>
                        @endif
                        @if($address)
                        <div>
                            <i class="fas fa-map-marker-alt me-2" style="color: var(--primary-color)"></i>
                            <span style="color: rgba(255,255,255,0.75);">{{ $address }}</span>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
                <!-- About Footer End -->
            </div>

            <div class="col-xl-8">
                <!-- Footer Links Box Start -->
                <div class="footer-links-box">
                    <!-- Quick Links -->
                    <div class="footer-links">
                        <h3>Quick Links</h3>
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('website.projects.index') }}">Projects</a></li>
                            <li><a href="{{ route('properties.index') }}">Investment Opportunities</a></li>
                            <li><a href="{{ route('blog.index') }}">Blog</a></li>
                            <li><a href="{{ route('careers') }}">Careers</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                    <!-- Quick Links End -->

                    <!-- Services Links -->
                    <div class="footer-links">
                        <h3>Our Services</h3>
                        <ul>
                            <li><a href="{{ route('services') }}">Developer Mandate Services</a></li>
                            <li><a href="{{ route('services') }}">Project Marketing Strategy</a></li>
                            <li><a href="{{ route('services') }}">Real Estate Investment Advisory</a></li>
                            <li><a href="{{ route('services') }}">Developer Partnerships</a></li>
                            <li><a href="{{ route('services') }}">Commercial Real Estate Consulting</a></li>
                        </ul>
                    </div>
                    <!-- Services Links End -->

                    <!-- Newsletter -->
                    <div class="footer-links footer-newsletter-form">
                        <h3>Subscribe Newsletter</h3>
                        <p>Subscribe to receive updates on new real estate projects, investment opportunities, and market insights.</p>
                        <form id="newslettersForm" action="#" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" class="form-control"
                                       placeholder="Enter Your Email" required />
                                <button type="submit" class="newsletter-btn">
                                    <i class="fa-regular fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- Newsletter End -->
                </div>
                <!-- Footer Links Box End -->
            </div>
        </div>
    </div>

    <!-- Footer Copyright Start -->
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-copyright-text">
                        <p>{!! $copyright !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Copyright End -->
</footer>
<!-- Main Footer End -->
