@extends('layouts.website')

@section('title', $project->meta_title ?? ($project->title . ' - ' . ($site['site_name'] ?? config('app.name'))))
@section('meta_description', $project->meta_description ?? $project->short_description)

@section('content')

    <!-- Page Header Start -->
    <div class="page-header bg-section dark-section parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque">{{ $project->title }}</h1>
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('website.projects.index') }}">Projects</a></li>
                                <li class="breadcrumb-item active">{{ Str::limit($project->title, 40) }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Project Detail Start -->
    <div class="project-detail" style="padding: 100px 0;">
        <div class="container">
            <div class="row g-5">

                {{-- Left: Images and Description --}}
                <div class="col-xl-8">

                    @if($project->images->isNotEmpty())
                        <div class="project-gallery mb-4">
                            <div class="project-main-image mb-2">
                                <figure style="overflow:hidden; border-radius:12px; margin:0;">
                                    <img src="{{ $project->images->first()->url }}"
                                         alt="{{ $project->title }}"
                                         id="main-gallery-img"
                                         style="width:100%;height:450px;object-fit:cover;" />
                                </figure>
                            </div>
                            @if($project->images->count() > 1)
                            <div class="d-flex gap-2 flex-wrap mt-2">
                                @foreach($project->images as $img)
                                <img src="{{ $img->url }}"
                                     alt="{{ $project->title }}"
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
                            <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}"
                                 style="width:100%;height:450px;object-fit:cover;" />
                        </figure>
                    @endif

                    @if($project->description || $project->short_description)
                    <div class="project-description wow fadeInUp" style="margin-bottom: 2rem;">
                        <div class="section-title">
                            <span class="section-sub-title">About This Project</span>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $project->title }}</h2>
                        </div>
                        @if($project->short_description)
                            <p class="lead">{{ $project->short_description }}</p>
                        @endif
                        @if($project->description)
                            <div>{!! nl2br(e($project->description)) !!}</div>
                        @endif
                    </div>
                    @endif

                    @if($project->google_maps_url)
                    <div class="project-map mb-4">
                        <h4 class="fw-bold mb-3">Location</h4>
                        <iframe src="{{ $project->google_maps_url }}"
                                width="100%" height="350" style="border:0;border-radius:12px;" allowfullscreen
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    @endif
                </div>

                {{-- Right: Info Sidebar --}}
                <div class="col-xl-4">

                    {{-- Status Card --}}
                    <div style="background: var(--primary-color); border-radius: 16px; padding: 28px; margin-bottom: 20px;">
                        <div style="font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: rgba(255,255,255,0.5); margin-bottom: 8px;">
                            Project Status
                        </div>
                        <span style="display: inline-block; font-size: 1.4rem; font-weight: 800;
                                     color: {{ $project->status === 'completed' ? '#4ade80' : '#fbbf24' }}; margin-bottom: 6px;">
                            {{ $project->status_label }}
                        </span>
                        @if($project->completion_year)
                        <div style="font-size: 13px; color: rgba(255,255,255,0.65); margin-top: 6px;">
                            <i class="fas fa-calendar me-1"></i>
                            {{ $project->status === 'completed' ? 'Completed' : 'Expected completion' }}: {{ $project->completion_year }}
                        </div>
                        @endif
                    </div>

                    {{-- Details Card --}}
                    <div style="background: #fff; border-radius: 16px; padding: 24px; margin-bottom: 20px; box-shadow: 0 4px 20px rgba(4,6,24,0.07);">
                        <h5 style="font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: var(--primary-color); margin-bottom: 16px; padding-bottom: 12px; border-bottom: 2px solid var(--divider-color);">
                            Project Details
                        </h5>
                        <div style="display: flex; flex-direction: column; gap: 12px;">

                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 13px; color: var(--text-color); display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-home" style="width: 16px; color: var(--primary-color);"></i>Type
                                </span>
                                <span style="font-size: 13px; font-weight: 700; color: var(--primary-color);">{{ $project->type_label }}</span>
                            </div>

                            @if($project->area)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 10px; border-top: 1px solid var(--divider-color);">
                                <span style="font-size: 13px; color: var(--text-color); display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-expand-arrows-alt" style="width: 16px; color: var(--primary-color);"></i>Area
                                </span>
                                <span style="font-size: 13px; font-weight: 700; color: var(--primary-color);">{{ number_format($project->area) }} {{ $project->area_unit }}</span>
                            </div>
                            @endif

                            @if($project->units)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 10px; border-top: 1px solid var(--divider-color);">
                                <span style="font-size: 13px; color: var(--text-color); display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-building" style="width: 16px; color: var(--primary-color);"></i>Units
                                </span>
                                <span style="font-size: 13px; font-weight: 700; color: var(--primary-color);">{{ $project->units }}</span>
                            </div>
                            @endif

                            @if($project->floors)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 10px; border-top: 1px solid var(--divider-color);">
                                <span style="font-size: 13px; color: var(--text-color); display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-layer-group" style="width: 16px; color: var(--primary-color);"></i>Floors
                                </span>
                                <span style="font-size: 13px; font-weight: 700; color: var(--primary-color);">{{ $project->floors }}</span>
                            </div>
                            @endif

                            @if($project->city)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 10px; border-top: 1px solid var(--divider-color);">
                                <span style="font-size: 13px; color: var(--text-color); display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-city" style="width: 16px; color: var(--primary-color);"></i>City
                                </span>
                                <span style="font-size: 13px; font-weight: 700; color: var(--primary-color);">{{ $project->city }}</span>
                            </div>
                            @endif

                            @if($project->location)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 10px; border-top: 1px solid var(--divider-color);">
                                <span style="font-size: 13px; color: var(--text-color); display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-map-marker-alt" style="width: 16px; color: var(--primary-color);"></i>Location
                                </span>
                                <span style="font-size: 13px; font-weight: 700; color: var(--primary-color); text-align: right; max-width: 55%;">{{ $project->location }}</span>
                            </div>
                            @endif

                        </div>
                    </div>

                    {{-- CTA Card --}}
                    <div style="background: var(--accent-secondary-color); border-radius: 16px; padding: 28px; text-align: center;">
                        <h5 style="font-size: 1.1rem; font-weight: 800; color: var(--primary-color); margin-bottom: 8px;">Interested in this project?</h5>
                        <p style="font-size: 13px; color: var(--primary-color); opacity: 0.75; margin-bottom: 20px; line-height: 1.5;">
                            Contact us for more details or to schedule a site visit.
                        </p>
                        <a href="{{ route('contact') }}" class="btn-default"
                           style="display: inline-block; background: var(--primary-color); color: var(--accent-secondary-color); padding: 12px 28px; border-radius: 8px; font-weight: 700; font-size: 14px; text-decoration: none; width: 100%; text-align: center;">
                            <i class="fas fa-phone me-2"></i>Enquire Now
                        </a>
                        @if(!empty($site['phone_primary']))
                        <div class="mt-3">
                            <a href="tel:{{ $site['phone_primary'] }}"
                               style="font-size: 13px; font-weight: 600; color: var(--primary-color); text-decoration: none;">
                                <i class="fas fa-phone me-1"></i>{{ $site['phone_primary'] }}
                            </a>
                        </div>
                        @endif
                    </div>

                </div>
            </div>

            {{-- Related Projects --}}
            @php $relatedItems = $related->where('id', '!=', $project->id)->take(3); @endphp
            @if($relatedItems->isNotEmpty())
            <div class="row mt-5">
                <div class="col-lg-12 mb-4">
                    <div class="section-title">
                        <span class="section-sub-title wow fadeInUp">More Projects</span>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Related <span>{{ $project->type_label }}</span> Projects</h2>
                    </div>
                </div>
                @foreach($relatedItems as $rel)
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="project-item wow fadeInUp">
                        <div class="project-item-image">
                            <a href="#" data-cursor-text="View">
                                <figure>
                                    <img src="{{ $rel->thumbnail_url }}" alt="{{ $rel->title }}"
                                         style="width:100%;height:220px;object-fit:cover;" />
                                </figure>
                            </a>
                        </div>
                        <div class="project-item-content">
                            <ul><li>{{ $rel->type_label }}</li></ul>
                            <h2><a href="#">{{ $rel->title }}</a></h2>
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
