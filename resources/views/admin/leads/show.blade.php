@extends('admin.layouts.app')

@section('title', $lead->first_name . ' ' . $lead->last_name)
@section('page-title', 'Lead Details')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.leads.index') }}">Leads</a></li>
    <li class="breadcrumb-item active">{{ $lead->first_name }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-4 pb-2">
                <h6 class="fw-bold mb-0">Lead Info</h6>
            </div>
            <div class="card-body">
                <h5 class="fw-bold">{{ $lead->first_name }} {{ $lead->last_name }}</h5>
                @php
                    $statusColors = ['new' => 'warning', 'contacted' => 'info', 'qualified' => 'primary', 'negotiating' => 'secondary', 'converted' => 'success', 'lost' => 'danger'];
                @endphp
                <span class="badge bg-{{ $statusColors[$lead->status] ?? 'secondary' }} mb-3">{{ ucfirst($lead->status) }}</span>

                <div class="small">
                    <p><i class="fas fa-envelope me-2 text-muted"></i>{{ $lead->email }}</p>
                    @if($lead->phone)<p><i class="fas fa-phone me-2 text-muted"></i>{{ $lead->phone }}</p>@endif
                    <p><i class="fas fa-tag me-2 text-muted"></i>Source: {{ $lead->source ?? '-' }}</p>
                    <p><i class="fas fa-calendar me-2 text-muted"></i>{{ $lead->created_at->format('M d, Y H:i') }}</p>
                </div>

                {{-- Update Status --}}
                <hr>
                <form method="POST" action="{{ route('admin.leads.status', $lead) }}">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label small fw-bold">Update Status</label>
                        <select name="status" class="form-select form-select-sm">
                            @foreach(['new', 'contacted', 'qualified', 'negotiating', 'converted', 'lost'] as $s)
                                <option value="{{ $s }}" {{ $lead->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-admin-primary btn-sm w-100">Update Status</button>
                </form>

                {{-- Assign --}}
                <hr>
                <form method="POST" action="{{ route('admin.leads.assign', $lead) }}">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label small fw-bold">Assign To</label>
                        <select name="assigned_to" class="form-select form-select-sm">
                            <option value="">Unassigned</option>
                            @foreach(\App\Models\User::where('is_active', true)->get() as $user)
                                <option value="{{ $user->id }}" {{ $lead->assigned_to == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary btn-sm w-100">Assign</button>
                </form>

                <hr>
                <form method="POST" action="{{ route('admin.leads.destroy', $lead) }}" onsubmit="return confirm('Delete this lead?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm w-100"><i class="fas fa-trash me-1"></i>Delete Lead</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        {{-- Add Note --}}
        <div class="card border-0 shadow-sm rounded-3 mb-3">
            <div class="card-header bg-white border-0 pt-4 pb-2">
                <h6 class="fw-bold mb-0">Add Note</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.leads.note', $lead) }}">
                    @csrf
                    <div class="mb-2">
                        <textarea name="note" class="form-control" rows="3" placeholder="Add a note..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-admin-primary btn-sm"><i class="fas fa-plus me-1"></i>Add Note</button>
                </form>
            </div>
        </div>

        {{-- Interactions / Timeline --}}
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-4 pb-2">
                <h6 class="fw-bold mb-0">Activity Timeline</h6>
            </div>
            <div class="card-body">
                @if($lead->interactions && $lead->interactions->count())
                    @foreach($lead->interactions as $interaction)
                        <div class="d-flex gap-3 mb-3 pb-3 border-bottom">
                            <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center flex-shrink-0" style="width:36px;height:36px;">
                                <i class="fas fa-comment-alt text-primary small"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <strong class="small">{{ $interaction->user->name ?? 'System' }}</strong>
                                    <small class="text-muted">{{ $interaction->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-0 small">{{ $interaction->note ?? $interaction->description ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center text-muted py-3">
                        <i class="fas fa-history fa-2x mb-2 d-block opacity-25"></i>
                        No activity yet.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
