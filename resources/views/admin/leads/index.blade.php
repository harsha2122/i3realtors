@extends('admin.layouts.app')

@section('title', 'Leads')
@section('page-title', 'Lead Management')
@section('breadcrumb')
    <li class="breadcrumb-item active">Leads</li>
@endsection

@section('content')
{{-- Stats Cards --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box bg-primary bg-opacity-10 text-primary"><i class="fas fa-users"></i></div>
                <div><div class="text-muted small">Total Leads</div><div class="fw-bold fs-5">{{ $stats['total'] ?? 0 }}</div></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box bg-warning bg-opacity-10 text-warning"><i class="fas fa-clock"></i></div>
                <div><div class="text-muted small">New</div><div class="fw-bold fs-5">{{ $stats['new'] ?? 0 }}</div></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box bg-info bg-opacity-10 text-info"><i class="fas fa-phone"></i></div>
                <div><div class="text-muted small">Contacted</div><div class="fw-bold fs-5">{{ $stats['contacted'] ?? 0 }}</div></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box bg-success bg-opacity-10 text-success"><i class="fas fa-check-circle"></i></div>
                <div><div class="text-muted small">Converted</div><div class="fw-bold fs-5">{{ $stats['converted'] ?? 0 }}</div></div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0"><i class="fas fa-envelope me-2" style="color:var(--primary)"></i>All Leads</h6>
        <a href="{{ route('admin.leads.export') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-download me-1"></i>Export CSV
        </a>
    </div>

    <div class="card-body p-0">
        @if($leads->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-envelope fa-3x mb-3 d-block opacity-25"></i>
                No leads yet.
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Source</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $lead)
                    <tr>
                        <td class="fw-semibold small">{{ $lead->first_name }} {{ $lead->last_name }}</td>
                        <td class="small">{{ $lead->email }}</td>
                        <td class="small">{{ $lead->phone ?? '-' }}</td>
                        <td><span class="badge bg-light text-dark border small">{{ $lead->source ?? '-' }}</span></td>
                        <td>
                            @php
                                $statusColors = ['new' => 'warning', 'contacted' => 'info', 'qualified' => 'primary', 'negotiating' => 'secondary', 'converted' => 'success', 'lost' => 'danger'];
                            @endphp
                            <span class="badge bg-{{ $statusColors[$lead->status] ?? 'secondary' }}">{{ ucfirst($lead->status) }}</span>
                        </td>
                        <td class="small text-muted">{{ $lead->created_at->diffForHumans() }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.leads.show', $lead) }}" class="btn btn-sm btn-outline-primary" title="View"><i class="fas fa-eye"></i></a>
                                <form method="POST" action="{{ route('admin.leads.destroy', $lead) }}" onsubmit="return confirm('Delete this lead?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $leads->links() }}</div>
        @endif
    </div>
</div>
@endsection
