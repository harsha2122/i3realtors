@extends('admin.layouts.app')

@section('title', 'Edit Service')
@section('page-title', 'Edit Service')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-4 pb-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-edit me-2" style="color:var(--primary)"></i>Edit: {{ $service->title }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $service->title) }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $service->slug) }}">
                        @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description', $service->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="icon" class="form-label">Icon Class</label>
                            <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon', $service->icon) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $service->category) }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="featured_image" class="form-label">Featured Image</label>
                        @if($service->featured_image)
                            <div class="mb-2"><img src="{{ asset('storage/' . $service->featured_image) }}" alt="" class="rounded" style="max-height:100px;"></div>
                        @endif
                        <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*">
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i>Update</button>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
