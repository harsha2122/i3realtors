@extends('admin.layouts.app')
@section('title', 'Career Applications')
@section('page-title', 'Career Applications')
@section('breadcrumb')
    <li class="breadcrumb-item active">Career Applications</li>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0"><i class="fas fa-file-alt me-2" style="color:var(--primary)"></i>All Applications</h6>
        <span class="badge bg-primary">{{ $applications->total() }} total</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success mx-3 mt-3">{{ session('success') }}</div>
    @endif

    <div class="card-body p-0">
        @if($applications->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-file-alt fa-3x mb-3 d-block opacity-25"></i>
                No applications yet.
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Applicant</th>
                        <th>Position Applied</th>
                        <th>Experience</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $app)
                    <tr class="{{ !$app->is_read ? 'fw-semibold' : '' }}">
                        <td>
                            <div>{{ $app->full_name }}</div>
                            <small class="text-muted">{{ $app->email }}</small>
                        </td>
                        <td class="small">{{ $app->job_title }}</td>
                        <td class="small text-muted">{{ $app->experience_years }} yr(s)</td>
                        <td class="small">{{ $app->phone }}</td>
                        <td class="small text-muted">{{ $app->created_at->format('M d, Y') }}</td>
                        <td>
                            @if(!$app->is_read)
                                <span class="badge bg-warning text-dark">New</span>
                            @else
                                <span class="badge bg-light text-muted">Read</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.career-applications.show', $app) }}" class="btn btn-sm btn-outline-primary" title="View"><i class="fas fa-eye"></i></a>
                                <form method="POST" action="{{ route('admin.career-applications.destroy', $app) }}" onsubmit="return confirm('Delete this application?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $applications->links() }}</div>
        @endif
    </div>
</div>
@endsection
