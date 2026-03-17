@extends('admin.layouts.app')

@section('title', 'Gallery')
@section('page-title', 'Gallery')
@section('breadcrumb')
    <li class="breadcrumb-item active">Gallery</li>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="fw-bold mb-0"><i class="fas fa-images me-2" style="color:var(--primary)"></i>Gallery Images</h6>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-admin-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Upload Images
        </a>
    </div>

    {{-- Filters --}}
    <div class="card-body border-bottom pb-3 pt-0">
        <form method="GET" action="{{ route('admin.gallery.index') }}" class="row g-2 align-items-end">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ $filters['search'] ?? '' }}"
                       class="form-control form-control-sm" placeholder="Search title, caption, category…" />
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select form-select-sm">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ ($filters['category'] ?? '') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="is_active" class="form-select form-select-sm">
                    <option value="">All</option>
                    <option value="1" {{ isset($filters['is_active']) && $filters['is_active'] === '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ isset($filters['is_active']) && $filters['is_active'] === '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-1">
                <button type="submit" class="btn btn-admin-primary btn-sm flex-fill">Filter</button>
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
            </div>
        </form>
    </div>

    <div class="card-body">
        @if($images->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-images fa-3x mb-3 d-block opacity-25"></i>
                No images found. <a href="{{ route('admin.gallery.create') }}">Upload the first one.</a>
            </div>
        @else
        <div class="row g-3">
            @foreach($images as $image)
            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="card border h-100 position-relative">
                    <img src="{{ $image->image_url }}" alt="{{ $image->title }}"
                         class="card-img-top" style="height: 140px; object-fit: cover;" />
                    @if(!$image->is_active)
                        <span class="badge bg-secondary position-absolute top-0 start-0 m-1" style="font-size:10px;">Draft</span>
                    @endif
                    <div class="card-body p-2">
                        @if($image->title)
                            <div class="fw-semibold" style="font-size:0.78rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $image->title }}</div>
                        @endif
                        @if($image->category)
                            <span class="badge bg-light text-dark border" style="font-size:10px;">{{ $image->category }}</span>
                        @endif
                        @if($image->caption)
                            <div class="text-muted mt-1" style="font-size:0.72rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $image->caption }}</div>
                        @endif
                    </div>
                    <div class="card-footer bg-white border-top p-1 d-flex gap-1">
                        <a href="{{ route('admin.gallery.edit', $image->id) }}"
                           class="btn btn-sm btn-outline-primary flex-fill" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.gallery.destroy', $image->id) }}"
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
        <div class="mt-3">{{ $images->withQueryString()->links() }}</div>
        @endif
    </div>
</div>
@endsection
