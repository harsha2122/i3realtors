@extends('layouts.website')

@section('title', 'Projects - ' . ($site['site_name'] ?? config('app.name')))
@section('meta_description', 'Explore our ongoing and completed real estate projects.')

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

            {{-- Status Tabs --}}
            @php $activeStatus = $filters['status'] ?? ''; @endphp
            <div class="d-flex justify-content-center mb-5">
                <div style="display:inline-flex; background: var(--accent-secondary-color); border-radius: 50px; padding: 6px; gap: 4px;">
                    <a href="{{ route('website.projects.index') }}"
                       style="display:inline-block; padding: 10px 28px; border-radius: 50px; font-size: 14px; font-weight: 700; text-decoration: none; transition: all 0.3s;
                              {{ $activeStatus === '' ? 'background: var(--primary-color); color: var(--accent-secondary-color);' : 'background: transparent; color: var(--primary-color);' }}">
                        All
                    </a>
                    <a href="{{ route('website.projects.index', ['status' => 'ongoing']) }}"
                       style="display:inline-block; padding: 10px 28px; border-radius: 50px; font-size: 14px; font-weight: 700; text-decoration: none; transition: all 0.3s;
                              {{ $activeStatus === 'ongoing' ? 'background: var(--primary-color); color: var(--accent-secondary-color);' : 'background: transparent; color: var(--primary-color);' }}">
                        Ongoing
                    </a>
                    <a href="{{ route('website.projects.index', ['status' => 'completed']) }}"
                       style="display:inline-block; padding: 10px 28px; border-radius: 50px; font-size: 14px; font-weight: 700; text-decoration: none; transition: all 0.3s;
                              {{ $activeStatus === 'completed' ? 'background: var(--primary-color); color: var(--accent-secondary-color);' : 'background: transparent; color: var(--primary-color);' }}">
                        Completed
                    </a>
                </div>
            </div>

            {{-- Filters --}}
            <form method="GET" action="{{ route('website.projects.index') }}" class="row g-2 mb-5 align-items-center">
                @if($activeStatus)
                    <input type="hidden" name="status" value="{{ $activeStatus }}" />
                @endif
                <div class="col-md-4">
                    <input type="text" name="search" value="{{ $filters['search'] ?? '' }}"
                           class="form-control"
                           style="border: 2px solid var(--divider-color); border-radius: 50px; padding: 10px 20px; font-size: 14px;"
                           placeholder="Search projects…" />
                </div>
                <div class="col-md-3">
                    <select name="type" class="form-select"
                            style="border: 2px solid var(--divider-color); border-radius: 50px; padding: 10px 20px; font-size: 14px;">
                        <option value="">All Types</option>
                        @foreach(['residential','commercial','industrial','infrastructure','mixed_use'] as $t)
                            <option value="{{ $t }}" {{ ($filters['type'] ?? '') === $t ? 'selected' : '' }}>{{ ucwords(str_replace('_',' ',$t)) }}</option>
                        @endforeach
                    </select>
                </div>
                @if($cities->isNotEmpty())
                <div class="col-md-3">
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
                    @if(!empty($filters['search']) || !empty($filters['type']) || !empty($filters['city']))
                        <a href="{{ route('website.projects.index', $activeStatus ? ['status' => $activeStatus] : []) }}"
                           style="display: inline-flex; align-items: center; padding: 10px 18px; border: 2px solid var(--divider-color); border-radius: 100px; font-size: 0.85rem; font-weight: 600; color: var(--text-color); text-decoration: none; transition: all 0.3s ease; white-space: nowrap;"
                           onmouseover="this.style.borderColor='var(--primary-color)';this.style.color='var(--primary-color)'"
                           onmouseout="this.style.borderColor='var(--divider-color)';this.style.color='var(--text-color)'">
                            <i class="fas fa-times me-1"></i> Clear
                        </a>
                    @endif
                </div>
            </form>

            @if($projects->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-city fa-3x mb-3" style="color: var(--primary-color); opacity:0.4;"></i>
                    <h4>No projects found</h4>
                    <p class="text-muted">Try adjusting your filters.</p>
                    <a href="{{ route('website.projects.index') }}" class="btn-default" style="padding: 12px 28px;">View All</a>
                </div>
            @else
                <div class="row">
                    @foreach($projects as $project)
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="project-item wow fadeInUp">
                            <div class="project-item-image">
                                <a href="{{ route('website.projects.show', $project->slug) }}" data-cursor-text="View">
                                    <figure>
                                        <img src="{{ $project->thumbnail_url }}"
                                             alt="{{ $project->title }}" />
                                    </figure>
                                </a>
                                {{-- Status badge --}}
                                <span style="position: absolute; top: 16px; right: 16px; z-index: 3;
                                             background: {{ $project->status === 'completed' ? '#22c55e' : '#f59e0b' }};
                                             color: #fff; font-size: 10px; font-weight: 700;
                                             padding: 4px 12px; border-radius: 20px;
                                             text-transform: uppercase; letter-spacing: 0.5px;">
                                    {{ $project->status_label }}
                                </span>
                                @if($project->is_featured)
                                    <span style="position: absolute; top: 16px; left: 16px; z-index: 3; background: var(--accent-secondary-color); color: var(--accent-color); font-size: 10px; font-weight: 700; padding: 4px 12px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;">
                                        <i class="fas fa-star me-1"></i>Featured
                                    </span>
                                @endif
                            </div>
                            <div class="project-item-content">
                                <ul>
                                    <li><a href="{{ route('website.projects.index') }}?type={{ $project->type }}">{{ $project->type_label }}</a></li>
                                    @if($project->city)
                                        <li>{{ $project->city }}</li>
                                    @endif
                                </ul>
                                <h2><a href="{{ route('website.projects.show', $project->slug) }}">{{ $project->title }}</a></h2>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    @if($project->area)
                                        <span style="font-size: 12px; color: rgba(255,255,255,0.75);">
                                            <i class="fas fa-expand me-1"></i>{{ number_format($project->area) }} {{ $project->area_unit }}
                                        </span>
                                    @endif
                                    @if($project->completion_year)
                                        <span style="font-size: 12px; color: rgba(255,255,255,0.75);">
                                            <i class="fas fa-calendar me-1"></i>{{ $project->completion_year }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $projects->withQueryString()->links() }}
                </div>
            @endif

        </div>
    </div>
    <!-- Projects Section End -->

@endsection
