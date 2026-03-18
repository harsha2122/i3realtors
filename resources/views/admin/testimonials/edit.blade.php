@extends('admin.layouts.app')

@section('title', 'Edit Testimonial')
@section('page-title', 'Edit Testimonial')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.testimonials.index') }}">Testimonials</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-4 pb-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-edit me-2" style="color:var(--primary)"></i>Edit Testimonial</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="author_name" class="form-label">Author Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('author_name') is-invalid @enderror" id="author_name" name="author_name" value="{{ old('author_name', $testimonial->author_name) }}" required>
                            @error('author_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="author_title" class="form-label">Title / Position</label>
                            <input type="text" class="form-control" id="author_title" name="author_title" value="{{ old('author_title', $testimonial->author_title) }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="company" class="form-label">Company</label>
                            <input type="text" class="form-control" id="company" name="company" value="{{ old('company', $testimonial->company) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="client_type" class="form-label">Client Type</label>
                            <select class="form-select" id="client_type" name="client_type">
                                <option value="">— Select —</option>
                                @foreach(['Buyer','Investor','Developer'] as $type)
                                    <option value="{{ $type }}" {{ old('client_type', $testimonial->client_type) === $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="project_name" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="project_name" name="project_name" value="{{ old('project_name', $testimonial->project_name) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="video_url" class="form-label">Video URL (optional)</label>
                            <input type="url" class="form-control" id="video_url" name="video_url" value="{{ old('video_url', $testimonial->video_url) }}" placeholder="https://youtube.com/...">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Testimonial Content <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="4" required>{{ old('content', $testimonial->content) }}</textarea>
                        @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="rating" class="form-label">Rating <span class="text-danger">*</span></label>
                            <select class="form-select" id="rating" name="rating" required>
                                @for($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label d-block">Featured</label>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $testimonial->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Mark as featured</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="author_image" class="form-label">Author Photo</label>
                            @if($testimonial->author_image)
                                <div class="mb-2"><img src="{{ asset('uploads/' . $testimonial->author_image) }}" alt="" class="rounded-circle" style="width:50px;height:50px;object-fit:cover;"></div>
                            @endif
                            <input type="file" class="form-control" id="author_image" name="author_image" accept="image/*">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="company_logo" class="form-label">Company Logo</label>
                            @if($testimonial->company_logo)
                                <div class="mb-2"><img src="{{ asset('uploads/' . $testimonial->company_logo) }}" alt="" class="rounded" style="max-height:50px;"></div>
                            @endif
                            <input type="file" class="form-control" id="company_logo" name="company_logo" accept="image/*">
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i>Update</button>
                        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
