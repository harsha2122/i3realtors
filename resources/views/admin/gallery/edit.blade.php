@extends('admin.layouts.app')

@section('title', 'Edit Gallery Image')
@section('page-title', 'Edit Gallery Image')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.gallery.index') }}">Gallery</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.gallery.update', $gallery->id) }}" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="row g-4">
        <div class="col-xl-8">
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <h6 class="fw-bold mb-0 small text-uppercase text-muted">Image Details</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text" name="title" value="{{ old('title', $gallery->title) }}"
                                   class="form-control @error('title') is-invalid @enderror"
                                   placeholder="e.g. Project Site Visit" />
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Category</label>
                            <input type="text" name="category" value="{{ old('category', $gallery->category) }}"
                                   class="form-control @error('category') is-invalid @enderror"
                                   list="category-list"
                                   placeholder="e.g. Events, Projects, Team…" />
                            <datalist id="category-list">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}">
                                @endforeach
                            </datalist>
                            @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Caption</label>
                            <textarea name="caption" rows="2"
                                      class="form-control @error('caption') is-invalid @enderror"
                                      maxlength="500">{{ old('caption', $gallery->caption) }}</textarea>
                            @error('caption') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Sort Order</label>
                            <input type="number" name="sort_order" min="0"
                                   value="{{ old('sort_order', $gallery->sort_order) }}"
                                   class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            {{-- Publish --}}
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <h6 class="fw-bold mb-0 small text-uppercase text-muted">Publish</h6>
                </div>
                <div class="card-body">
                    <div class="form-check form-switch">
                        <input type="hidden" name="is_active" value="0" />
                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                               id="is_active" {{ old('is_active', $gallery->is_active ? '1' : '0') == '1' ? 'checked' : '' }} />
                        <label class="form-check-label fw-semibold" for="is_active">Active (visible on site)</label>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 pb-3">
                    <button type="submit" class="btn btn-admin-primary w-100">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary w-100 mt-2">Cancel</a>
                </div>
            </div>

            {{-- Current Image --}}
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <h6 class="fw-bold mb-0 small text-uppercase text-muted">Image</h6>
                </div>
                <div class="card-body">
                    <img src="{{ $gallery->image_url }}" alt="{{ $gallery->title }}"
                         id="img-preview"
                         class="img-fluid rounded mb-3" style="width:100%; height:180px; object-fit:cover;" />
                    <label class="form-label fw-semibold">Replace Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                           accept="image/*" onchange="previewReplace(this)" />
                    <div class="form-text">Max 5MB. Leave blank to keep current.</div>
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
function previewReplace(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { document.getElementById('img-preview').src = e.target.result; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
