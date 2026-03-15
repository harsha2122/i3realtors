@extends('layouts.website')

@section('title', 'Properties - ' . ($site['site_name'] ?? config('app.name')))
@section('meta_description', 'Explore our residential, commercial, and industrial real estate properties.')

@section('content')

    <!-- Page Header Start -->
    <div class="page-header bg-section dark-section parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque">Our Properties</h1>
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Properties</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Properties Section Start -->
    <div class="our-project page-project" style="padding: 80px 0;">
        <div class="container">

            {{-- Filters --}}
            <form method="GET" action="{{ route('properties.index') }}" class="row g-2 mb-5 align-items-center">
                <div class="col-md-4">
                    <input type="text" name="search" value="{{ $filters['search'] ?? '' }}"
                           class="form-control"
                           style="border: 2px solid var(--divider-color); border-radius: 50px; padding: 10px 20px; font-size: 14px;"
                           placeholder="Search properties…" />
                </div>
                <div class="col-md-2">
                    <select name="type" class="form-select"
                            style="border: 2px solid var(--divider-color); border-radius: 50px; padding: 10px 20px; font-size: 14px;">
                        <option value="">All Types</option>
                        @foreach(['residential','commercial','industrial','infrastructure','plot'] as $t)
                            <option value="{{ $t }}" {{ ($filters['type'] ?? '') === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select"
                            style="border: 2px solid var(--divider-color); border-radius: 50px; padding: 10px 20px; font-size: 14px;">
                        <option value="">All Status</option>
                        @foreach(['available','under_construction','coming_soon','sold'] as $s)
                            <option value="{{ $s }}" {{ ($filters['status'] ?? '') === $s ? 'selected' : '' }}>{{ ucwords(str_replace('_',' ',$s)) }}</option>
                        @endforeach
                    </select>
                </div>
                @if($cities->isNotEmpty())
                <div class="col-md-2">
                    <select name="city" class="form-select"
                            style="border: 2px solid var(--divider-color); border-radius: 50px; padding: 10px 20px; font-size: 14px;">
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
                        <a href="{{ route('properties.index') }}"
                           style="display: inline-flex; align-items: center; padding: 10px 18px; border: 2px solid var(--divider-color); border-radius: 100px; font-size: 0.85rem; font-weight: 600; color: var(--text-color); text-decoration: none; transition: all 0.3s ease; white-space: nowrap;"
                           onmouseover="this.style.borderColor='var(--primary-color)';this.style.color='var(--primary-color)'"
                           onmouseout="this.style.borderColor='var(--divider-color)';this.style.color='var(--text-color)'">
                            <i class="fas fa-times me-1"></i> Clear
                        </a>
                    @endif
                </div>
            </form>

            @if($properties->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-building fa-3x mb-3" style="color: var(--primary-color); opacity:0.4;"></i>
                    <h4>No properties found</h4>
                    <p class="text-muted">Try adjusting your filters.</p>
                    <a href="{{ route('properties.index') }}" class="btn-default" style="padding: 12px 28px;">View All</a>
                </div>
            @else
                <div class="row">
                    @foreach($properties as $property)
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="project-item wow fadeInUp">
                            <div class="project-item-image">
                                <a href="{{ route('properties.show', $property->slug) }}" data-cursor-text="View">
                                    <figure>
                                        <img src="{{ $property->thumbnail_url }}"
                                             alt="{{ $property->title }}" />
                                    </figure>
                                </a>
                                <span style="position: absolute; top: 16px; right: 16px; z-index: 3; background: var(--accent-secondary-color); color: var(--accent-color); font-size: 10px; font-weight: 700; padding: 4px 12px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;">
                                    {{ $property->status_label }}
                                </span>
                                @if($property->is_featured)
                                    <span style="position: absolute; top: 16px; left: 16px; z-index: 3; background: var(--accent-secondary-color); color: var(--accent-color); font-size: 10px; font-weight: 700; padding: 4px 12px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;">
                                        <i class="fas fa-star me-1"></i>Featured
                                    </span>
                                @endif
                            </div>
                            <div class="project-item-content">
                                <ul>
                                    <li><a href="{{ route('properties.index') }}?type={{ $property->type }}">{{ $property->type_label }}</a></li>
                                    @if($property->city)
                                        <li>{{ $property->city }}</li>
                                    @endif
                                </ul>
                                <h2><a href="{{ route('properties.show', $property->slug) }}">{{ $property->title }}</a></h2>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span style="font-weight: 700; font-size: 15px; color: var(--accent-secondary-color);">{{ $property->formatted_price }}</span>
                                    @if($property->area)
                                        <span style="font-size: 12px; color: rgba(255,255,255,0.75);">
                                            <i class="fas fa-expand me-1"></i>{{ number_format($property->area) }} {{ $property->area_unit }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $properties->withQueryString()->links() }}
                </div>
            @endif

        </div>
    </div>
    <!-- Properties Section End -->

@endsection
