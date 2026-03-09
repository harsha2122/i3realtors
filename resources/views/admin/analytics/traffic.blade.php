@extends('admin.layouts.app')

@section('title', 'Traffic Analytics')
@section('page-title', 'Traffic Analytics')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.analytics.dashboard') }}">Analytics</a></li>
    <li class="breadcrumb-item active">Traffic</li>
@endsection

@section('content')
{{-- Date Filter --}}
<div class="card border-0 shadow-sm rounded-3 mb-4">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('admin.analytics.traffic') }}" class="row g-2 align-items-end">
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
                <a href="{{ route('admin.analytics.traffic') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-3">
        <h6 class="fw-bold mb-0"><i class="fas fa-globe me-2" style="color:var(--primary)"></i>Traffic Sources</h6>
    </div>
    <div class="card-body p-0">
        @if(count($traffic ?? []) > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Source</th>
                        <th>Visits</th>
                        <th>Percentage</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = collect($traffic)->sum('visits'); @endphp
                    @foreach($traffic as $source)
                    <tr>
                        <td class="fw-semibold small">{{ $source->source ?? '-' }}</td>
                        <td class="small">{{ number_format($source->visits ?? 0) }}</td>
                        <td>
                            @php $pct = $total > 0 ? round(($source->visits / $total) * 100, 1) : 0; @endphp
                            <div class="d-flex align-items-center gap-2">
                                <div class="progress flex-grow-1" style="height: 6px;">
                                    <div class="progress-bar" style="width: {{ $pct }}%; background: var(--primary);"></div>
                                </div>
                                <span class="small text-muted">{{ $pct }}%</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <div class="text-center text-muted py-5">
                <i class="fas fa-globe fa-3x mb-3 d-block opacity-25"></i>
                No traffic data available.
            </div>
        @endif
    </div>
</div>
@endsection
