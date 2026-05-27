@extends('layouts.website')
@section('title', 'Events — ' . (\App\Models\Setting::get('site_name', config('app.name'))))

@section('content')

<!-- Page Header Start -->
<div class="page-header bg-section dark-section parallaxie">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque">Events</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Events</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Events Section Start -->
<section class="ev-section">
    <div class="container">

        @if($events->isEmpty())
            <div class="ev-empty text-center py-5">
                <div class="ev-empty-icon">
                    <i class="fas fa-calendar-times"></i>
                </div>
                <h3 class="ev-empty-title">No Upcoming Events</h3>
                <p class="ev-empty-text">Check back soon — exciting events are in the works.</p>
                <a href="{{ route('home') }}" class="btn-default btn-sm mt-3">Back to Home</a>
            </div>
        @else

        <!-- Section Header -->
        <div class="row section-row mb-5">
            <div class="col-xl-7">
                <div class="section-title">
                    <span class="section-sub-title wow fadeInUp">What's On</span>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">
                        Upcoming <span>Events</span>
                    </h2>
                </div>
            </div>
            <div class="col-xl-5">
                <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                    <p>Join us at our exclusive real estate events, investor meets, and project showcases. Network with industry leaders and discover your next investment opportunity.</p>
                </div>
            </div>
        </div>

        <!-- Events Grid -->
        <div class="ev-grid">
            @foreach($events as $index => $event)
            @php
                $isPast = $event->event_date && $event->event_date->isPast();
                $isSoldOut = !is_null($event->available_seats) && $event->available_seats <= 0;
            @endphp
            <a href="{{ route('events.show', $event) }}" class="ev-card wow fadeInUp" data-wow-delay="{{ ($index % 3) * 0.1 }}s">
                <!-- Card Number -->
                <span class="ev-card__num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>

                <!-- Status Badge -->
                <div class="ev-card__badges">
                    @if($isPast)
                        <span class="ev-badge ev-badge--past">Past</span>
                    @elseif($isSoldOut)
                        <span class="ev-badge ev-badge--soldout">Sold Out</span>
                    @else
                        <span class="ev-badge ev-badge--open">Open</span>
                    @endif
                </div>

                <!-- Main Content -->
                <div class="ev-card__body">
                    <h3 class="ev-card__title">{{ $event->title }}</h3>

                    @if($event->description)
                        <p class="ev-card__desc">{{ Str::limit(strip_tags($event->description), 120) }}</p>
                    @endif
                </div>

                <!-- Meta Row -->
                <div class="ev-card__meta">
                    @if($event->event_date)
                    <div class="ev-meta-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>{{ $event->event_date->format('d M Y') }}</span>
                        @if($event->event_time)
                            <span class="ev-meta-sep">·</span>
                            <span>{{ $event->event_time }}</span>
                        @endif
                    </div>
                    @endif

                    @if($event->location)
                    <div class="ev-meta-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $event->location }}</span>
                    </div>
                    @endif

                    @if($event->total_capacity)
                    <div class="ev-meta-item">
                        <i class="fas fa-users"></i>
                        <span>
                            @if($isSoldOut)
                                Sold Out
                            @else
                                {{ $event->available_seats ?? $event->total_capacity }} seats available
                            @endif
                        </span>
                    </div>
                    @endif
                </div>

                <!-- Arrow CTA -->
                <div class="ev-card__cta">
                    <span>View Details</span>
                    <span class="ev-arrow"><i class="fas fa-arrow-right"></i></span>
                </div>
            </a>
            @endforeach
        </div>

        @endif
    </div>
</section>
<!-- Events Section End -->

@endsection

@push('styles')
<style>
/* ===== Events Page ===== */
.ev-section {
    padding: 100px 0 120px;
    background: #f9f9f9;
}

/* Grid */
.ev-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}
@media (max-width: 992px) { .ev-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 576px)  { .ev-grid { grid-template-columns: 1fr; } }

/* Card */
.ev-card {
    display: flex;
    flex-direction: column;
    background: #fff;
    border: 1px solid #ebebeb;
    border-radius: 16px;
    padding: 32px 28px 24px;
    text-decoration: none;
    color: inherit;
    position: relative;
    overflow: hidden;
    transition: box-shadow 0.3s, transform 0.3s, border-color 0.3s;
}
.ev-card:hover {
    box-shadow: 0 12px 40px rgba(0,0,0,0.10);
    transform: translateY(-4px);
    border-color: var(--accent-secondary-color, #dcff09);
    color: inherit;
}

/* Number watermark */
.ev-card__num {
    position: absolute;
    top: 20px;
    right: 24px;
    font-size: 4rem;
    font-weight: 800;
    color: #f0f0f0;
    line-height: 1;
    user-select: none;
    transition: color 0.3s;
}
.ev-card:hover .ev-card__num { color: #e8e8e8; }

/* Badges */
.ev-card__badges { margin-bottom: 16px; }
.ev-badge {
    display: inline-block;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    padding: 4px 12px;
    border-radius: 50px;
}
.ev-badge--open    { background: #e6f9f0; color: #14845a; }
.ev-badge--soldout { background: #fff3e0; color: #b35c00; }
.ev-badge--past    { background: #f0f0f0; color: #888; }

/* Body */
.ev-card__body { flex: 1; margin-bottom: 20px; }
.ev-card__title {
    font-size: 1.15rem;
    font-weight: 700;
    line-height: 1.35;
    margin-bottom: 10px;
    color: #1a1a2e;
}
.ev-card__desc {
    font-size: 0.875rem;
    color: #666;
    line-height: 1.65;
    margin: 0;
}

/* Meta */
.ev-card__meta {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 16px 0;
    border-top: 1px solid #f0f0f0;
    margin-bottom: 16px;
}
.ev-meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.8rem;
    color: #555;
}
.ev-meta-item i { color: var(--accent-color, #040618); width: 14px; flex-shrink: 0; }
.ev-meta-sep { opacity: 0.4; }

/* CTA */
.ev-card__cta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--accent-color, #040618);
}
.ev-arrow {
    width: 32px; height: 32px;
    background: var(--accent-secondary-color, #dcff09);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px;
    transition: transform 0.3s;
}
.ev-card:hover .ev-arrow { transform: translateX(4px); }

/* Empty State */
.ev-empty-icon {
    width: 80px; height: 80px;
    background: #f0f0f0;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 2rem;
    color: #bbb;
    margin: 0 auto 20px;
}
.ev-empty-title { font-size: 1.4rem; font-weight: 700; color: #1a1a2e; margin-bottom: 8px; }
.ev-empty-text  { color: #888; }
</style>
@endpush
