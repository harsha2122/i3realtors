@extends('admin.layouts.app')
@section('title', 'Add Job')
@section('page-title', 'Add Job')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.career-jobs.index') }}">Career Jobs</a></li>
    <li class="breadcrumb-item active">Add Job</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-9">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-4 pb-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-plus me-2" style="color:var(--primary)"></i>New Job Opening</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.career-jobs.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label fw-semibold">Job Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="e.g. Sales Executive" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                            <select class="form-select @error('category') is-invalid @enderror" name="category" required>
                                <option value="">-- Select --</option>
                                @foreach(['sales','marketing','operations','presales','admin'] as $cat)
                                    <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                                @endforeach
                            </select>
                            @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Employment Type <span class="text-danger">*</span></label>
                            <select class="form-select" name="employment_type" required>
                                @foreach(['Full-Time','Part-Time','Contract','Internship'] as $type)
                                    <option value="{{ $type }}" {{ old('employment_type','Full-Time') === $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Location <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="location" value="{{ old('location','Pune') }}" placeholder="e.g. Pune" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Experience</label>
                            <input type="text" class="form-control" name="experience" value="{{ old('experience') }}" placeholder="e.g. 1–3 Years">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Job Description</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Brief summary of the role...">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Key Responsibilities</label>
                        <small class="text-muted d-block mb-1">One item per line</small>
                        <textarea class="form-control" name="responsibilities" rows="5" placeholder="Client acquisition and relationship management&#10;Investor presentations and site visits&#10;Pipeline management and deal closures">{{ old('responsibilities') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Requirements</label>
                        <small class="text-muted d-block mb-1">One item per line</small>
                        <textarea class="form-control" name="requirements" rows="5" placeholder="1–3 years in real estate sales&#10;Strong communication and negotiation skills&#10;Knowledge of Pune real estate market">{{ old('requirements') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select class="form-select" name="status">
                                <option value="active" {{ old('status','active') === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Sort Order</label>
                            <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i>Create Job</button>
                        <a href="{{ route('admin.career-jobs.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
