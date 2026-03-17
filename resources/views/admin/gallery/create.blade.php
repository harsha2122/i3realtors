@extends('admin.layouts.app')

@section('title', 'Upload Gallery Images')
@section('page-title', 'Upload Gallery Images')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.gallery.index') }}">Gallery</a></li>
    <li class="breadcrumb-item active">Upload</li>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="row g-4">
        <div class="col-xl-8">
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <h6 class="fw-bold mb-0 small text-uppercase text-muted">Upload Images</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Images <span class="text-danger">*</span></label>
                        <input type="file" name="images[]" class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                               accept="image/*" multiple required
                               onchange="previewImages(this)" />
                        <div class="form-text">Select one or multiple images. Max 5MB each. JPG, PNG, WebP.</div>
                        @error('images') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        @error('images.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    {{-- Preview area --}}
                    <div id="image-preview" class="row g-2 mt-1"></div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <h6 class="fw-bold mb-0 small text-uppercase text-muted">Details (applied to all uploaded images)</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                   class="form-control @error('title') is-invalid @enderror"
                                   placeholder="e.g. Project Site Visit" />
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Category</label>
                            <input type="text" name="category" value="{{ old('category') }}"
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
                                      maxlength="500"
                                      placeholder="Optional caption or description">{{ old('caption') }}</textarea>
                            @error('caption') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Sort Order</label>
                            <input type="number" name="sort_order" min="0"
                                   value="{{ old('sort_order', 0) }}"
                                   class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <h6 class="fw-bold mb-0 small text-uppercase text-muted">Publish</h6>
                </div>
                <div class="card-body">
                    <div class="form-check form-switch">
                        <input type="hidden" name="is_active" value="0" />
                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                               id="is_active" {{ old('is_active', '1') == '1' ? 'checked' : '' }} />
                        <label class="form-check-label fw-semibold" for="is_active">Active (visible on site)</label>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 pb-3">
                    <button type="submit" class="btn btn-admin-primary w-100">
                        <i class="fas fa-upload me-2"></i>Upload Images
                    </button>
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary w-100 mt-2">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
function previewImages(input) {
    const container = document.getElementById('image-preview');
    container.innerHTML = '';
    if (!input.files || !input.files.length) return;
    Array.from(input.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const col = document.createElement('div');
            col.className = 'col-3';
            col.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded" style="height:80px;width:100%;object-fit:cover;" />`;
            container.appendChild(col);
        };
        reader.readAsDataURL(file);
    });
}
</script>
@endpush
