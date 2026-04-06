@extends('admin.layouts.app')

@section('title', 'Team Gallery')
@section('page-title', 'Team Gallery')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.team.index') }}">Team</a></li>
    <li class="breadcrumb-item active">Gallery</li>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<!-- Upload Card -->
<div class="card border-0 shadow-sm rounded-3 mb-4">
    <div class="card-header bg-white border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0"><i class="fas fa-images me-2" style="color:var(--primary)"></i>Team Gallery Images</h6>
        <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i>Back to Team
        </a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.team-gallery.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Upload Images</label>
                <input type="file" name="images[]" class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                       multiple accept="image/*">
                <div class="form-text">You can select multiple images at once. Max 4 MB each.</div>
                @error('images') <div class="invalid-feedback">{{ $message }}</div> @enderror
                @error('images.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-admin-primary">
                <i class="fas fa-upload me-1"></i>Upload Images
            </button>
        </form>
    </div>
</div>

<!-- Images Grid -->
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-3">
        <h6 class="fw-bold mb-0">Uploaded Images ({{ $images->count() }})</h6>
    </div>
    <div class="card-body">
        @if($images->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-images fa-3x mb-3 d-block opacity-25"></i>
                No images uploaded yet.
            </div>
        @else
        <div class="row g-3">
            @foreach($images as $image)
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                <div class="border rounded-3 overflow-hidden position-relative {{ $image->is_active ? '' : 'opacity-50' }}">
                    <div style="aspect-ratio:1/1; overflow:hidden;">
                        <img src="{{ asset('uploads/' . $image->image_path) }}" alt=""
                             style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <div class="p-2 d-flex gap-1 justify-content-between align-items-center bg-white border-top">
                        <!-- Toggle visibility -->
                        <form method="POST" action="{{ route('admin.team-gallery.toggle', $image) }}">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $image->is_active ? 'btn-success' : 'btn-outline-secondary' }}"
                                    title="{{ $image->is_active ? 'Active – click to hide' : 'Hidden – click to show' }}">
                                <i class="fas {{ $image->is_active ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                            </button>
                        </form>
                        <!-- Delete -->
                        <form method="POST" action="{{ route('admin.team-gallery.destroy', $image) }}"
                              onsubmit="return confirm('Delete this image?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@endsection
