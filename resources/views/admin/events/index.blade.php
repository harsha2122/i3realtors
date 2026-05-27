@extends('admin.layouts.app')
@section('title', 'Events')
@section('page-title', 'Events')
@section('breadcrumb')
    <li class="breadcrumb-item active">Events</li>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0"><i class="fas fa-calendar-star me-2" style="color:var(--primary)"></i>All Events</h6>
        <a href="{{ route('admin.events.create') }}" class="btn btn-admin-primary btn-sm"><i class="fas fa-plus me-1"></i>Add Event</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mx-3 mt-3">{{ session('success') }}</div>
    @endif

    <div class="card-body p-0">
        @if($events->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-calendar fa-3x mb-3 d-block opacity-25"></i>
                No events yet. <a href="{{ route('admin.events.create') }}">Add the first one.</a>
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th width="110">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td class="fw-semibold">{{ $event->title }}</td>
                        <td class="small text-muted">{{ $event->event_date ? $event->event_date->format('d M Y') : '—' }}</td>
                        <td class="small text-muted">{{ $event->location ?? '—' }}</td>
                        <td class="small">
                            @if($event->total_capacity)
                                {{ $event->available_seats ?? '?' }} / {{ $event->total_capacity }}
                            @else —
                            @endif
                        </td>
                        <td>
                            @if($event->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.events.destroy', $event) }}" onsubmit="return confirm('Delete this event?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $events->links() }}</div>
        @endif
    </div>
</div>
@endsection
