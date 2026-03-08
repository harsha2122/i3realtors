@extends('layouts.website')

@section('title', 'Projects - ' . ($site['site_name'] ?? config('app.name')))
@section('meta_description', 'Explore our residential, commercial, and industrial real estate projects.')

@section('content')

    <!-- Page Header Start -->
    <div class="page-header bg-section dark-section parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque">Our Projects</h1>
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Projects</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Projects Section Start -->
    <div class="our-project page-project" style="padding: 80px 0;">
        <div class="container">

            {{-- Filters --}}
            <form method="GET" action="{{ route('projects.index') }}" class="row g-2 mb-5">
                <div class="col-md-4">
                    <input type="text" name="search" value="{{ $filters['search'] ?? '' }}"
                           class="form-control" placeholder="Search projects…" />
                </div>
                <div class="col-md-2">
                    <select name="type" class="form-select">
                        <option value="">All Types</option>
                        @foreach(['residential','commercial','industrial','infrastructure','plot'] as $t)
                            <option value="{{ $t }}" {{ ($filters['type'] ?? '') === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        @foreach(['available','under_construction','coming_soon','sold'] as $s)
                            <option value="{{ $s }}" {{ ($filters['status'] ?? '') === $s ? 'selected' : '' }}>{{ ucwords(str_replace('_',' ',$s)) }}</option>
                        @endforeach
                    </select>
                </div>
                @if($cities->isNotEmpty())
                <div class="col-md-2">
                    <select name="city" class="form-select">
                        <option value="">All Cities</option>
                        @foreach($cities as $city)
                            <option value="{{ $city }}" {{ ($filters['city'] ?? '') === $city ? 'selected' : '' }}>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn-default flex-fill" style="padding: 10px 16px; font-size: 0.9rem;">Filter</button>
                    @if(array_filter($filters))
                        <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary" style="padding: 10px 16px;">Clear</a>
                    @endif
                </div>
            </form>

            @if($properties->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-building fa-3x mb-3" style="color: var(--primary-color); opacity:0.4;"></i>
                    <h4>No projects found</h4>
                    <p class="text-muted">Try adjusting your filters.</p>
                    <a href="{{ route('projects.index') }}" class="btn-default" style="padding: 12px 28px;">View All</a>
                </div>
            @else
                <div class="row">
                    @foreach($properties as $property)
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="project-item wow fadeInUp">
                            <div class="project-item-image">
                                <a href="{{ route('projects.show', $property->slug) }}" data-cursor-text="View">
                                    <figure>
                                        <img src="{{ $property->thumbnail_url }}"
                                             alt="{{ $property->title }}"
                                             style="width:100%;height:260px;object-fit:cover;" />
                                    </figure>
                                </a>
                                @if($property->is_featured)
                                    <span class="position-absolute top-0 start-0 m-2 badge"
                                          style="background: var(--primary-color); color:#000; font-size:0.7rem;">
                                        <i class="fas fa-star me-1"></i>Featured
                                    </span>
                                @endif
                            </div>
                            <div class="project-item-content">
                                <ul>
                                    <li><a href="{{ route('projects.index') }}?type={{ $property->type }}">{{ $property->type_label }}</a></li>
                                    <li>
                                        <span class="badge bg-{{ $property->status_badge }} ms-2" style="font-size:0.7rem;">
                                            {{ $property->status_label }}
                                        </span>
                                    </li>
                                </ul>
                                <h2><a href="{{ route('projects.show', $property->slug) }}">{{ $property->title }}</a></h2>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    @if($property->city)
                                        <span class="small text-muted">
                                            <i class="fas fa-map-marker-alt me-1" style="color:var(--primary-color)"></i>{{ $property->city }}
                                        </span>
                                    @endif
                                    <span class="fw-bold" style="color: var(--primary-color);">{{ $property->formatted_price }}</span>
                                </div>
                                @if($property->area)
                                    <div class="small text-muted mt-1">
                                        <i class="fas fa-expand me-1"></i>{{ number_format($property->area) }} {{ $property->area_unit }}
                                        @if($property->bedrooms)
                                            &nbsp;|&nbsp; <i class="fas fa-bed me-1"></i>{{ $property->bedrooms }} Bed
                                        @endif
                                        @if($property->bathrooms)
                                            &nbsp;|&nbsp; <i class="fas fa-bath me-1"></i>{{ $property->bathrooms }} Bath
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $properties->withQueryString()->links() }}
                </div>
            @endif

        </div>
    </div>
    <!-- Projects Section End -->

@endsection
