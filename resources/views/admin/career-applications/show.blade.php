@extends('admin.layouts.app')
@section('title', 'Application Details')
@section('page-title', 'Application Details')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.career-applications.index') }}">Applications</a></li>
    <li class="breadcrumb-item active">{{ $careerApplication->full_name }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0"><i class="fas fa-user me-2" style="color:var(--primary)"></i>{{ $careerApplication->full_name }}</h6>
                <span class="badge bg-success">Read</span>
            </div>
            <div class="card-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="text-muted small">Full Name</label>
                        <div class="fw-semibold">{{ $careerApplication->full_name }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Email</label>
                        <div><a href="mailto:{{ $careerApplication->email }}">{{ $careerApplication->email }}</a></div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Phone</label>
                        <div>{{ $careerApplication->phone }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Position Applied</label>
                        <div class="fw-semibold">{{ $careerApplication->job_title }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Years of Experience</label>
                        <div>{{ $careerApplication->experience_years }} year(s)</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Applied On</label>
                        <div>{{ $careerApplication->created_at->format('M d, Y h:i A') }}</div>
                    </div>
                </div>

                @if($careerApplication->cover_letter)
                <div class="mb-4">
                    <label class="text-muted small">Cover Letter</label>
                    <div class="p-3 bg-light rounded mt-1" style="white-space:pre-wrap;">{{ $careerApplication->cover_letter }}</div>
                </div>
                @endif

                @if($careerApplication->resume_path)
                <div class="mb-4">
                    <label class="text-muted small">Resume / CV</label>
                    <div class="mt-1">
                        <a href="{{ asset('storage/' . $careerApplication->resume_path) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-download me-1"></i>Download Resume (PDF)
                        </a>
                    </div>
                </div>
                @endif

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('admin.career-applications.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i>Back to Applications</a>
                    <form method="POST" action="{{ route('admin.career-applications.destroy', $careerApplication) }}" onsubmit="return confirm('Delete this application?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash me-1"></i>Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
