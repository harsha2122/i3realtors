@php
    $logoWhite   = \App\Models\Setting::get('logo_white');
    $siteName    = \App\Models\Setting::get('site_name', config('app.name'));
    $footerAbout = \App\Models\Setting::get('footer_about', '');
    $footerCta   = \App\Models\Setting::get('footer_cta_title', 'Begin your construction journey with trusted experts');
    $copyright   = \App\Models\Setting::get('footer_copyright', 'Copyright &copy; ' . date('Y') . ' All Rights Reserved.');

    // Contact
    $phone1  = \App\Models\Setting::get('phone_primary', '');
    $phone2  = \App\Models\Setting::get('phone_secondary', '');
    $email   = \App\Models\Setting::get('email_primary', '');
    $address = \App\Models\Setting::get('address', '');

    // Social
    $socials = [
        'facebook'  => ['url' => \App\Models\Setting::get('social_facebook'),  'icon' => 'fa-brands fa-facebook-f'],
        'twitter'   => ['url' => \App\Models\Setting::get('social_twitter'),   'icon' => 'fa-brands fa-x-twitter'],
        'instagram' => ['url' => \App\Models\Setting::get('social_instagram'), 'icon' => 'fa-brands fa-instagram'],
        'linkedin'  => ['url' => \App\Models\Setting::get('social_linkedin'),  'icon' => 'fa-brands fa-linkedin-in'],
        'youtube'   => ['url' => \App\Models\Setting::get('social_youtube'),   'icon' => 'fa-brands fa-youtube'],
        'pinterest' => ['url' => \App\Models\Setting::get('social_pinterest'), 'icon' => 'fa-brands fa-pinterest-p'],
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
                            <img src="{{ asset('storage/' . $logoWhite) }}" alt="{{ $siteName }}" />
                        @else
                            <img src="{{ asset('images/logo-white.svg') }}" alt="{{ $siteName }}" />
                        @endif
                    </div>
                    @if($footerAbout)
                    <div class="about-footer-content">
                        <p>{{ $footerAbout }}</p>
                    </div>
                    @endif

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
                            <li><a href="{{ route('services') }}">Our Services</a></li>
                            <li><a href="{{ route('projects.index') }}">Projects</a></li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        </ul>
                    </div>
                    <!-- Quick Links End -->

                    <!-- Services Links -->
                    <div class="footer-links">
                        <h3>Our Services</h3>
                        <ul>
                            <li><a href="{{ route('services') }}">Residential Construction</a></li>
                            <li><a href="{{ route('services') }}">Commercial Construction</a></li>
                            <li><a href="{{ route('services') }}">Real Estate Development</a></li>
                            <li><a href="{{ route('services') }}">Renovation &amp; Remodeling</a></li>
                            <li><a href="{{ route('services') }}">Design &amp; Planning</a></li>
                        </ul>
                    </div>
                    <!-- Services Links End -->

                    <!-- Newsletter -->
                    <div class="footer-links footer-newsletter-form">
                        <h3>Subscribe Newsletter</h3>
                        <p>** Subscribe to receive the latest updates, insights, and project news.</p>
                        <form id="newslettersForm" action="#" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" class="form-control"
                                       placeholder="Enter Your E-mail" required />
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
