@extends('admin.layouts.app')
@section('title', 'Career Jobs')
@section('page-title', 'Career Jobs')
@section('breadcrumb')
    <li class="breadcrumb-item active">Career Jobs</li>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0"><i class="fas fa-briefcase me-2" style="color:var(--primary)"></i>All Job Openings</h6>
        <a href="{{ route('admin.career-jobs.create') }}" class="btn btn-admin-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Add Job
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mx-3 mt-3">{{ session('success') }}</div>
    @endif

    <div class="card-body p-0">
        @if($jobs->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-briefcase fa-3x mb-3 d-block opacity-25"></i>
                No jobs found. <a href="{{ route('admin.career-jobs.create') }}">Add the first one.</a>
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Location</th>
                        <th>Experience</th>
                        <th>Status</th>
                        <th>Applications</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $job)
                    <tr>
                        <td class="fw-semibold">{{ $job->title }}</td>
                        <td><span class="badge bg-secondary bg-opacity-10 text-secondary">{{ ucfirst($job->category) }}</span></td>
                        <td class="small">{{ $job->employment_type }}</td>
                        <td class="small text-muted"><i class="fas fa-map-marker-alt me-1"></i>{{ $job->location }}</td>
                        <td class="small text-muted">{{ $job->experience ?? '—' }}</td>
                        <td>
                            @if($job->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.career-applications.index') }}?job={{ $job->id }}" class="badge bg-primary bg-opacity-10 text-primary text-decoration-none">
                                {{ $job->applications()->count() }}
                            </a>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.career-jobs.edit', $job) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.career-jobs.destroy', $job) }}" onsubmit="return confirm('Delete this job posting?')">
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
        <div class="p-3">{{ $jobs->links() }}</div>
        @endif
    </div>
</div>
@endsection
