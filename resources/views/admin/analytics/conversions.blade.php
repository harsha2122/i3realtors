@extends('admin.layouts.app')

@section('title', 'Conversions')
@section('page-title', 'Conversions')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.analytics.dashboard') }}">Analytics</a></li>
    <li class="breadcrumb-item active">Conversions</li>
@endsection

@section('content')
{{-- Date Filter --}}
<div class="card border-0 shadow-sm rounded-3 mb-4">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('admin.analytics.conversions') }}" class="row g-2 align-items-end">
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
                <a href="{{ route('admin.analytics.conversions') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
            </div>
        </form>
    </div>
</div>

{{-- Stats --}}
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
                <div class="icon-box bg-warning bg-opacity-10 text-warning"><i class="fas fa-user-plus"></i></div>
                <div><div class="text-muted small">New Leads</div><div class="fw-bold fs-5">{{ number_format($metrics['new_leads'] ?? 0) }}</div></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box bg-success bg-opacity-10 text-success"><i class="fas fa-check-circle"></i></div>
                <div><div class="text-muted small">Conversions</div><div class="fw-bold fs-5">{{ number_format($metrics['conversions'] ?? 0) }}</div></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box bg-info bg-opacity-10 text-info"><i class="fas fa-percentage"></i></div>
                <div><div class="text-muted small">Conversion Rate</div><div class="fw-bold fs-5">{{ $metrics['conversion_rate'] ?? 0 }}%</div></div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-3">
        <h6 class="fw-bold mb-0"><i class="fas fa-chart-line me-2" style="color:var(--primary)"></i>Conversion Funnel</h6>
    </div>
    <div class="card-body">
        @php
            $pageViews = $metrics['page_views'] ?? 0;
            $leads = $metrics['new_leads'] ?? 0;
            $conversions = $metrics['conversions'] ?? 0;
        @endphp
        <div class="row text-center">
            <div class="col-md-4">
                <div class="p-3 bg-primary bg-opacity-10 rounded-3 mb-2">
                    <div class="fw-bold fs-4 text-primary">{{ number_format($pageViews) }}</div>
                    <div class="small text-muted">Page Views</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 bg-warning bg-opacity-10 rounded-3 mb-2">
                    <div class="fw-bold fs-4 text-warning">{{ number_format($leads) }}</div>
                    <div class="small text-muted">Leads Generated</div>
                </div>
                @if($pageViews > 0)
                    <small class="text-muted">{{ round(($leads / $pageViews) * 100, 2) }}% of visitors</small>
                @endif
            </div>
            <div class="col-md-4">
                <div class="p-3 bg-success bg-opacity-10 rounded-3 mb-2">
                    <div class="fw-bold fs-4 text-success">{{ number_format($conversions) }}</div>
                    <div class="small text-muted">Conversions</div>
                </div>
                @if($leads > 0)
                    <small class="text-muted">{{ round(($conversions / $leads) * 100, 2) }}% of leads</small>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
