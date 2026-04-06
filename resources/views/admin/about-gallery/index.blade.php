@extends('admin.layouts.app')

@section('title', 'About Page Gallery')
@section('page-title', 'About Page Gallery')
@section('breadcrumb')
    <li class="breadcrumb-item active">About Page Gallery</li>
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
    <div class="card-header bg-white border-0 pt-4 pb-3">
        <h6 class="fw-bold mb-0"><i class="fas fa-images me-2" style="color:var(--primary)"></i>Upload Gallery Images</h6>
        <p class="text-muted small mt-1 mb-0">These images appear in the gallery slider on the About page (below Achievements). Upload square images for best results.</p>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.about-gallery.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Select Images <span class="text-muted fw-normal">(multiple allowed)</span></label>
                <input type="file" name="images[]" id="galInput"
                       class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                       multiple accept="image/*" onchange="previewImages(this)">
                <div class="form-text">Max 5 MB each. Recommended: square images (1:1 ratio).</div>
                @error('images')   <div class="invalid-feedback">{{ $message }}</div> @enderror
                @error('images.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Preview -->
            <div id="galPreview" class="row g-2 mb-3" style="display:none!important;"></div>

            <button type="submit" class="btn btn-admin-primary">
                <i class="fas fa-upload me-1"></i>Upload
            </button>
        </form>
    </div>
</div>

<!-- Images Grid -->
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-3">
        <h6 class="fw-bold mb-0">Uploaded Images <span class="text-muted fw-normal">({{ $images->count() }})</span></h6>
    </div>
    <div class="card-body">
        @if($images->isEmpty())
        <div class="text-center text-muted py-5">
            <i class="fas fa-images fa-3x mb-3 d-block opacity-25"></i>
            No images yet. Upload some above.
        </div>
        @else
        <div class="row g-3">
            @foreach($images as $image)
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                <div class="border rounded-3 overflow-hidden {{ $image->is_active ? '' : 'opacity-50' }}">
                    <div style="aspect-ratio:1/1; overflow:hidden;">
                        <img src="{{ asset('uploads/' . $image->image_path) }}" alt=""
                             style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <div class="p-2 d-flex gap-1 justify-content-between bg-white border-top">
                        <form method="POST" action="{{ route('admin.about-gallery.toggle', $image) }}">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $image->is_active ? 'btn-success' : 'btn-outline-secondary' }}"
                                    title="{{ $image->is_active ? 'Visible – click to hide' : 'Hidden – click to show' }}">
                                <i class="fas {{ $image->is_active ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.about-gallery.destroy', $image) }}"
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

@push('scripts')
<script>
function previewImages(input) {
    var preview = document.getElementById('galPreview');
    preview.innerHTML = '';
    if (!input.files.length) { preview.style.setProperty('display','none','important'); return; }
    preview.style.removeProperty('display');
    Array.from(input.files).forEach(function(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var col = document.createElement('div');
            col.className = 'col-xl-2 col-lg-3 col-md-4 col-sm-6';
            col.innerHTML = '<div style="aspect-ratio:1/1;border-radius:8px;overflow:hidden;border:2px dashed #ccc;">'
                + '<img src="'+e.target.result+'" style="width:100%;height:100%;object-fit:cover;">'
                + '</div>';
            preview.appendChild(col);
        };
        reader.readAsDataURL(file);
    });
}
</script>
@endpush
