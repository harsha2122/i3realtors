@extends('admin.layouts.app')

@section('title', 'Analytics Dashboard')
@section('page-title', 'Analytics Dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item active">Analytics</li>
@endsection

@section('content')
{{-- Date Filter --}}
<div class="card border-0 shadow-sm rounded-3 mb-4">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('admin.analytics.dashboard') }}" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label small">From</label>
                <input type="date" name="date_from" class="form-control form-control-sm" value="{{ request('date_from') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small">To</label>
                <input type="date" name="date_to" class="form-control form-control-sm" value="{{ request('date_to') }}">
            </div>
            <div class="col-md-3 d-flex gap-1">
                <button type="submit" class="btn btn-admin-primary btn-sm">Filter</button>
                <a href="{{ route('admin.analytics.dashboard') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
            </div>
            <div class="col-md-3 text-end">
                <a href="{{ route('admin.analytics.export', request()->all()) }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-download me-1"></i>Export
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Stats Cards --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box bg-primary bg-opacity-10 text-primary"><i class="fas fa-eye"></i></div>
                <div><div class="text-muted small">Page Views</div><div class="fw-bold fs-5">{{ number_format($metrics['page_views'] ?? 0) }}</div></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box bg-success bg-opacity-10 text-success"><i class="fas fa-users"></i></div>
                <div><div class="text-muted small">Unique Visitors</div><div class="fw-bold fs-5">{{ number_format($metrics['unique_visitors'] ?? 0) }}</div></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box bg-warning bg-opacity-10 text-warning"><i class="fas fa-user-plus"></i></div>
                <div><div class="text-muted small">New Leads</div><div class="fw-bold fs-5">{{ number_format($metrics['new_leads'] ?? 0) }}</div></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box bg-info bg-opacity-10 text-info"><i class="fas fa-chart-line"></i></div>
                <div><div class="text-muted small">Conversion Rate</div><div class="fw-bold fs-5">{{ $metrics['conversion_rate'] ?? 0 }}%</div></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- Top Pages --}}
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-4 pb-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-file me-2" style="color:var(--primary)"></i>Top Pages</h6>
            </div>
            <div class="card-body p-0">
                @if(count($topPages ?? []) > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr><th>Page</th><th>Views</th></tr>
                        </thead>
                        <tbody>
                            @foreach($topPages as $page)
                            <tr>
                                <td class="small">{{ $page->page ?? '-' }}</td>
                                <td class="small fw-semibold">{{ number_format($page->views ?? 0) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="text-center text-muted py-4 small">No data available.</div>
                @endif
            </div>
        </div>
    </div>

    {{-- Traffic Sources --}}
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-4 pb-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-globe me-2" style="color:var(--primary)"></i>Traffic Sources</h6>
            </div>
            <div class="card-body p-0">
                @if(count($trafficSources ?? []) > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr><th>Source</th><th>Visits</th></tr>
                        </thead>
                        <tbody>
                            @foreach($trafficSources as $source)
                            <tr>
                                <td class="small">{{ $source->source ?? '-' }}</td>
                                <td class="small fw-semibold">{{ number_format($source->visits ?? 0) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="text-center text-muted py-4 small">No data available.</div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Quick Links --}}
<div class="row">
    <div class="col-12">
        <div class="d-flex gap-2">
            <a href="{{ route('admin.analytics.traffic') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-globe me-1"></i>Detailed Traffic</a>
            <a href="{{ route('admin.analytics.conversions') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-chart-line me-1"></i>Conversions</a>
        </div>
    </div>
</div>
@endsection
