@extends('admin.layouts.app')
@section('title', 'Edit Achievement')
@section('page-title', 'Edit Achievement')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.achievements.index') }}">Achievements</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-4 pb-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-edit me-2" style="color:var(--primary)"></i>Edit Achievement</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.achievements.update', $achievement) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $achievement->title) }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subtitle</label>
                        <input type="text" name="subtitle" class="form-control @error('subtitle') is-invalid @enderror"
                               value="{{ old('subtitle', $achievement->subtitle) }}">
                        @error('subtitle')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $achievement->description) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        @if($achievement->image)
                            <div class="mb-2">
                                <img src="{{ asset('uploads/' . $achievement->image) }}" alt="{{ $achievement->title }}"
                                     id="imgPreview" style="max-height:120px;border-radius:6px;">
                            </div>
                        @else
                            <img id="imgPreview" src="" alt="" style="display:none;margin-bottom:8px;max-height:120px;border-radius:6px;">
                        @endif
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                               accept="image/*" onchange="previewImg(this)">
                        <div class="form-text">Leave empty to keep current image. JPG or PNG, max 4MB.</div>
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="sort_order" class="form-control"
                                   value="{{ old('sort_order', $achievement->sort_order) }}" min="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label d-block">Status</label>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="is_active" value="1" id="is_active"
                                       {{ $achievement->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active (show on website)</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i>Update</button>
                        <a href="{{ route('admin.achievements.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImg(input) {
    const preview = document.getElementById('imgPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
