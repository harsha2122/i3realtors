@extends('layouts.website')

@section('title', $property->meta_title ?? ($property->title . ' - ' . ($site['site_name'] ?? config('app.name'))))
@section('meta_description', $property->meta_description ?? $property->short_description)

@section('content')

    <!-- Page Header Start -->
    <div class="page-header bg-section dark-section parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque">{{ $property->title }}</h1>
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
                                <li class="breadcrumb-item active">{{ Str::limit($property->title, 40) }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Project Detail Start -->
    <div class="project-detail" style="padding: 80px 0;">
        <div class="container">
            <div class="row g-5">

                {{-- Left: Images and Description --}}
                <div class="col-xl-8">

                    @if($property->images->isNotEmpty())
                        <div class="project-gallery mb-4">
                            <div class="project-main-image mb-2">
                                <figure style="overflow:hidden; border-radius:12px; margin:0;">
                                    <img src="{{ $property->images->first()->url }}"
                                         alt="{{ $property->title }}"
                                         id="main-gallery-img"
                                         style="width:100%;height:450px;object-fit:cover;" />
                                </figure>
                            </div>
                            @if($property->images->count() > 1)
                            <div class="d-flex gap-2 flex-wrap mt-2">
                                @foreach($property->images as $img)
                                <img src="{{ $img->url }}"
                                     alt="{{ $property->title }}"
                                     onclick="document.getElementById('main-gallery-img').src=this.src"
                                     class="rounded"
                                     style="height:80px;width:110px;object-fit:cover;cursor:pointer;border:2px solid transparent;transition:border-color 0.2s;"
                                     onmouseover="this.style.borderColor='var(--primary-color)'"
                                     onmouseout="this.style.borderColor='transparent'" />
                                @endforeach
                            </div>
                            @endif
                        </div>
                    @else
                        <figure style="border-radius:12px;overflow:hidden;margin-bottom:2rem;">
                            <img src="{{ $property->thumbnail_url }}" alt="{{ $property->title }}"
                                 style="width:100%;height:450px;object-fit:cover;" />
                        </figure>
                    @endif

                    @if($property->description || $property->short_description)
                    <div class="project-description wow fadeInUp" style="margin-bottom: 2rem;">
                        <div class="section-title">
                            <span class="section-sub-title">About This Project</span>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $property->title }}</h2>
                        </div>
                        @if($property->short_description)
                            <p class="lead">{{ $property->short_description }}</p>
                        @endif
                        @if($property->description)
                            <div>{!! nl2br(e($property->description)) !!}</div>
                        @endif
                    </div>
                    @endif

                    @if($property->google_maps_url)
                    <div class="project-map mb-4">
                        <h4 class="fw-bold mb-3">Location</h4>
                        <iframe src="{{ $property->google_maps_url }}"
                                width="100%" height="350" style="border:0;border-radius:12px;" allowfullscreen
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    @endif
                </div>

                {{-- Right: Info Sidebar --}}
                <div class="col-xl-4">
                    <div class="card border-0 shadow-sm rounded-3 mb-4 p-4">
                        <div class="fw-bold" style="font-size:1.8rem; color: var(--primary-color);">
                            {{ $property->formatted_price }}
                        </div>
                        <div class="text-muted small text-capitalize">For {{ $property->price_type }}</div>
                        <hr />
                        <dl class="row g-2 small mb-0">
                            <dt class="col-6 text-muted fw-normal">Status</dt>
                            <dd class="col-6"><span class="badge bg-{{ $property->status_badge }}">{{ $property->status_label }}</span></dd>

                            <dt class="col-6 text-muted fw-normal">Type</dt>
                            <dd class="col-6 fw-semibold">{{ $property->type_label }}</dd>

                            @if($property->area)
                            <dt class="col-6 text-muted fw-normal">Area</dt>
                            <dd class="col-6 fw-semibold">{{ number_format($property->area) }} {{ $property->area_unit }}</dd>
                            @endif

                            @if($property->bedrooms)
                            <dt class="col-6 text-muted fw-normal">Bedrooms</dt>
                            <dd class="col-6 fw-semibold">{{ $property->bedrooms }}</dd>
                            @endif

                            @if($property->bathrooms)
                            <dt class="col-6 text-muted fw-normal">Bathrooms</dt>
                            <dd class="col-6 fw-semibold">{{ $property->bathrooms }}</dd>
                            @endif

                            @if($property->floors)
                            <dt class="col-6 text-muted fw-normal">Floors</dt>
                            <dd class="col-6 fw-semibold">{{ $property->floors }}</dd>
                            @endif

                            @if($property->city)
                            <dt class="col-6 text-muted fw-normal">City</dt>
                            <dd class="col-6 fw-semibold">{{ $property->city }}</dd>
                            @endif

                            @if($property->location)
                            <dt class="col-6 text-muted fw-normal">Location</dt>
                            <dd class="col-6 fw-semibold">{{ $property->location }}</dd>
                            @endif
                        </dl>
                    </div>

                    <div class="card border-0 shadow-sm rounded-3 mb-4 p-4 text-center"
                         style="background: var(--primary-color);">
                        <h5 class="text-white fw-bold mb-2">Interested in this property?</h5>
                        <p class="text-white mb-3" style="opacity:0.9;font-size:0.9rem;">
                            Contact us for a site visit or more details.
                        </p>
                        <a href="{{ route('contact') }}" class="btn btn-light fw-bold" style="border-radius:8px;">
                            <i class="fas fa-phone me-2"></i>Enquire Now
                        </a>
                        @if(!empty($site['phone_primary']))
                        <div class="mt-3">
                            <a href="tel:{{ $site['phone_primary'] }}" class="text-white text-decoration-none small">
                                <i class="fas fa-phone me-1"></i>{{ $site['phone_primary'] }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Related Projects --}}
            @php $relatedItems = $related->where('id', '!=', $property->id)->take(3); @endphp
            @if($relatedItems->isNotEmpty())
            <div class="row mt-5">
                <div class="col-lg-12 mb-4">
                    <div class="section-title">
                        <span class="section-sub-title wow fadeInUp">More Projects</span>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Related <span>{{ $property->type_label }}</span> Projects</h2>
                    </div>
                </div>
                @foreach($relatedItems as $rel)
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="project-item wow fadeInUp">
                        <div class="project-item-image">
                            <a href="{{ route('projects.show', $rel->slug) }}" data-cursor-text="View">
                                <figure>
                                    <img src="{{ $rel->thumbnail_url }}" alt="{{ $rel->title }}"
                                         style="width:100%;height:220px;object-fit:cover;" />
                                </figure>
                            </a>
                        </div>
                        <div class="project-item-content">
                            <ul><li>{{ $rel->type_label }}</li></ul>
                            <h2><a href="{{ route('projects.show', $rel->slug) }}">{{ $rel->title }}</a></h2>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

        </div>
    </div>
    <!-- Project Detail End -->

@endsection
