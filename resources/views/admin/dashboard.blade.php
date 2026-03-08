@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="row g-4 mb-4">

    {{-- Stat Cards --}}
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box" style="background: rgba(184,150,43,0.15)">
                    <i class="fas fa-users" style="color: var(--primary)"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Users</div>
                    <div class="fs-4 fw-bold">{{ $stats['total_users'] }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card stat-card p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box" style="background: rgba(25,135,84,0.15)">
                    <i class="fas fa-sign-in-alt" style="color: #198754"></i>
                </div>
                <div>
                    <div class="text-muted small">Logins (7 days)</div>
                    <div class="fs-4 fw-bold">{{ $stats['recent_logins'] }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card stat-card p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box" style="background: rgba(13,110,253,0.15)">
                    <i class="fas fa-building" style="color: #0d6efd"></i>
                </div>
                <div>
                    <div class="text-muted small">Properties</div>
                    <div class="fs-4 fw-bold">—</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card stat-card p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box" style="background: rgba(220,53,69,0.15)">
                    <i class="fas fa-envelope" style="color: #dc3545"></i>
                </div>
                <div>
                    <div class="text-muted small">Leads</div>
                    <div class="fs-4 fw-bold">—</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- Recent Activity --}}
    <div class="col-xl-8">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0"><i class="fas fa-history me-2 text-muted"></i>Recent Activity</h6>
            </div>
            <div class="card-body p-0">
                @if($recentActivity->isEmpty())
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>No activity yet
                    </div>
                @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="fw-semibold ps-3">User</th>
                                <th class="fw-semibold">Event</th>
                                <th class="fw-semibold">IP Address</th>
                                <th class="fw-semibold">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentActivity as $log)
                            <tr>
                                <td class="ps-3">
                                    <div class="d-flex align-items-center gap-2">
                                        @if($log->user)
                                            <img src="{{ $log->user->avatar_url }}" class="rounded-circle" width="28" height="28" />
                                            {{ $log->user->name }}
                                        @else
                                            <span class="text-muted">System</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $badge = match($log->event) {
                                            'logged_in'  => 'success',
                                            'logged_out' => 'secondary',
                                            'created'    => 'primary',
                                            'updated'    => 'warning',
                                            'deleted'    => 'danger',
                                            default      => 'info',
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $badge }}-subtle text-{{ $badge }} border border-{{ $badge }}-subtle">
                                        {{ ucfirst(str_replace('_', ' ', $log->event)) }}
                                    </span>
                                </td>
                                <td class="text-muted small">{{ $log->ip_address ?? '—' }}</td>
                                <td class="text-muted small">{{ $log->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Quick Links --}}
    <div class="col-xl-4">
        <div class="card border-0 shadow-sm rounded-3 h-100">
            <div class="card-header bg-white border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0"><i class="fas fa-bolt me-2 text-muted"></i>Quick Actions</h6>
            </div>
            <div class="card-body d-flex flex-column gap-2">
                <a href="#" class="btn btn-outline-secondary text-start">
                    <i class="fas fa-plus me-2" style="color: var(--primary)"></i>Add Property
                </a>
                <a href="#" class="btn btn-outline-secondary text-start">
                    <i class="fas fa-pencil me-2" style="color: var(--primary)"></i>Write Blog Post
                </a>
                <a href="#" class="btn btn-outline-secondary text-start">
                    <i class="fas fa-envelope me-2" style="color: var(--primary)"></i>View Leads
                </a>
                <a href="{{ route('admin.settings.group', 'branding') }}" class="btn btn-outline-secondary text-start">
                    <i class="fas fa-palette me-2" style="color: var(--primary)"></i>Edit Branding
                </a>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary text-start">
                    <i class="fas fa-users me-2" style="color: var(--primary)"></i>Manage Users
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
