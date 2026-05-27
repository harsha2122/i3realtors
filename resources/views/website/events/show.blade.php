@extends('layouts.website')
@section('title', $event->title . ' — Events — ' . (\App\Models\Setting::get('site_name', config('app.name'))))
@section('meta_description', Str::limit(strip_tags($event->description ?? ''), 160))

@section('content')

<!-- Page Header Start -->
<div class="page-header bg-section dark-section parallaxie">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque">{{ $event->title }}</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
                            <li class="breadcrumb-item active">{{ Str::limit($event->title, 40) }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Event Detail Start -->
<section class="evd-section">
    <div class="container">
        <div class="row g-5">

            <!-- Left: Main Content -->
            <div class="col-lg-8">

                <!-- Cover Image / Gallery -->
                @if($event->images && count($event->images) > 0)
                <div class="evd-gallery mb-5">
                    <!-- Cover -->
                    <a href="{{ Storage::url($event->images[0]) }}" class="evd-lightbox evd-cover"
                       data-gallery="event-gallery" title="{{ $event->title }}">
                        <img src="{{ Storage::url($event->images[0]) }}" alt="{{ $event->title }}" class="evd-cover-img" />
                        <div class="evd-cover-overlay"><i class="fas fa-expand-alt"></i></div>
                    </a>

                    <!-- Thumbnails row (images 2+) -->
                    @if(count($event->images) > 1)
                    <div class="evd-thumbs">
                        @foreach(array_slice($event->images, 1) as $img)
                        <a href="{{ Storage::url($img) }}" class="evd-lightbox evd-thumb"
                           data-gallery="event-gallery" title="{{ $event->title }}">
                            <img src="{{ Storage::url($img) }}" alt="" />
                            @if($loop->last && count($event->images) > 4)
                                <div class="evd-thumb-more">+{{ count($event->images) - 4 }}</div>
                            @endif
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endif

                <!-- Description -->
                @if($event->description)
                <div class="evd-desc wow fadeInUp">
                    <h3 class="evd-section-heading">About This Event</h3>
                    <div class="evd-body-text">
                        {!! nl2br(e($event->description)) !!}
                    </div>
                </div>
                @endif

            </div>

            <!-- Right: Info Sidebar -->
            <div class="col-lg-4">
                <div class="evd-sidebar wow fadeInRight" data-wow-delay="0.15s">

                    @php
                        $isPast   = $event->event_date && $event->event_date->isPast();
                        $isSoldOut = !is_null($event->available_seats) && $event->available_seats <= 0;
                    @endphp

                    <!-- Status Banner -->
                    @if($isPast)
                        <div class="evd-status evd-status--past">This event has passed</div>
                    @elseif($isSoldOut)
                        <div class="evd-status evd-status--soldout">Sold Out</div>
                    @else
                        <div class="evd-status evd-status--open">Registration Open</div>
                    @endif

                    <!-- Info List -->
                    <ul class="evd-info-list">
                        @if($event->event_date)
                        <li class="evd-info-item">
                            <span class="evd-info-icon"><i class="fas fa-calendar-alt"></i></span>
                            <div>
                                <span class="evd-info-label">Date</span>
                                <span class="evd-info-value">{{ $event->event_date->format('l, d F Y') }}</span>
                            </div>
                        </li>
                        @endif

                        @if($event->event_time)
                        <li class="evd-info-item">
                            <span class="evd-info-icon"><i class="fas fa-clock"></i></span>
                            <div>
                                <span class="evd-info-label">Time</span>
                                <span class="evd-info-value">{{ $event->event_time }}</span>
                            </div>
                        </li>
                        @endif

                        @if($event->location)
                        <li class="evd-info-item">
                            <span class="evd-info-icon"><i class="fas fa-map-marker-alt"></i></span>
                            <div>
                                <span class="evd-info-label">Venue</span>
                                <span class="evd-info-value">{{ $event->location }}</span>
                            </div>
                        </li>
                        @endif

                        @if($event->total_capacity)
                        <li class="evd-info-item">
                            <span class="evd-info-icon"><i class="fas fa-users"></i></span>
                            <div>
                                <span class="evd-info-label">Capacity</span>
                                <span class="evd-info-value">{{ $event->total_capacity }} seats</span>
                            </div>
                        </li>
                        @endif

                        @if(!is_null($event->available_seats))
                        <li class="evd-info-item">
                            <span class="evd-info-icon"><i class="fas fa-ticket-alt"></i></span>
                            <div>
                                <span class="evd-info-label">Available Seats</span>
                                <span class="evd-info-value @if($isSoldOut) text-danger fw-bold @elseif($event->available_seats < 20) text-warning fw-bold @endif">
                                    @if($isSoldOut)
                                        Sold Out
                                    @else
                                        {{ $event->available_seats }} remaining
                                    @endif
                                </span>
                            </div>
                        </li>
                        @endif
                    </ul>

                    <!-- CTA -->
                    @if(!$isPast && !$isSoldOut)
                    <div class="evd-cta mt-4">
                        <a href="{{ route('contact') }}" class="btn-default w-100 text-center">
                            Reserve Your Seat
                        </a>
                        <p class="evd-cta-note">Contact us to confirm your registration</p>
                    </div>
                    @endif

                    <!-- Back Link -->
                    <a href="{{ route('events.index') }}" class="evd-back-link">
                        <i class="fas fa-arrow-left me-2"></i>All Events
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Event Detail End -->

@endsection

@push('styles')
<style>
/* ===== Event Detail Page ===== */
.evd-section {
    padding: 80px 0 120px;
    background: #f9f9f9;
}

/* Gallery */
.evd-cover {
    display: block;
    border-radius: 16px;
    overflow: hidden;
    position: relative;
    margin-bottom: 10px;
}
.evd-cover-img {
    width: 100%;
    height: 420px;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}
.evd-cover:hover .evd-cover-img { transform: scale(1.03); }
.evd-cover-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.5rem;
    opacity: 0;
    transition: all 0.3s;
}
.evd-cover:hover .evd-cover-overlay { background: rgba(0,0,0,0.25); opacity: 1; }

.evd-thumbs {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 8px;
}
.evd-thumb {
    display: block;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
    aspect-ratio: 1;
}
.evd-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; }
.evd-thumb:hover img { transform: scale(1.05); }
.evd-thumb-more {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.55);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.2rem;
    font-weight: 700;
    border-radius: 10px;
}

/* Description */
.evd-section-heading {
    font-size: 1.3rem;
    font-weight: 700;
    color: #1a1a2e;
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 2px solid var(--accent-secondary-color, #dcff09);
    display: inline-block;
}
.evd-body-text {
    font-size: 0.95rem;
    line-height: 1.8;
    color: #444;
}

/* Sidebar */
.evd-sidebar {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #ebebeb;
    overflow: hidden;
    position: sticky;
    top: 100px;
}

.evd-status {
    padding: 14px 24px;
    font-size: 0.82rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    text-align: center;
}
.evd-status--open    { background: var(--accent-secondary-color, #dcff09); color: #1a1a2e; }
.evd-status--soldout { background: #fff3e0; color: #b35c00; }
.evd-status--past    { background: #f0f0f0; color: #888; }

/* Info list */
.evd-info-list {
    list-style: none;
    padding: 20px 24px;
    margin: 0;
}
.evd-info-item {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 14px 0;
    border-bottom: 1px solid #f5f5f5;
}
.evd-info-item:last-child { border-bottom: none; }

.evd-info-icon {
    width: 36px;
    height: 36px;
    background: #f5f5f5;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 14px;
    color: var(--accent-color, #040618);
    margin-top: 2px;
}
.evd-info-label {
    display: block;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    color: #999;
    margin-bottom: 3px;
}
.evd-info-value {
    display: block;
    font-size: 0.9rem;
    font-weight: 600;
    color: #1a1a2e;
    line-height: 1.4;
}

/* CTA */
.evd-cta { padding: 0 24px; }
.evd-cta .btn-default {
    display: block;
    text-align: center;
    padding: 14px 20px;
    border-radius: 10px;
}
.evd-cta-note {
    font-size: 0.75rem;
    color: #aaa;
    text-align: center;
    margin-top: 8px;
    margin-bottom: 0;
}

/* Back link */
.evd-back-link {
    display: flex;
    align-items: center;
    padding: 16px 24px;
    font-size: 0.85rem;
    font-weight: 600;
    color: #555;
    border-top: 1px solid #f0f0f0;
    text-decoration: none;
    transition: color 0.2s;
    margin-top: 16px;
}
.evd-back-link:hover { color: var(--accent-color, #040618); }

@media (max-width: 768px) {
    .evd-cover-img { height: 260px; }
    .evd-thumbs { grid-template-columns: repeat(3, 1fr); }
    .evd-sidebar { position: static; }
}
</style>
@endpush

@push('scripts')
<script>
$(function() {
    if (typeof $.fn.magnificPopup !== 'undefined') {
        $('.evd-lightbox').magnificPopup({
            type: 'image',
            gallery: { enabled: true, navigateByImgClick: true },
            image: { titleSrc: 'title' },
            removalDelay: 300,
            mainClass: 'mfp-fade'
        });
    }
});
</script>
@endpush
