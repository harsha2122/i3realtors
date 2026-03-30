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
                        <label class="form-label">Developer Name <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $achievement->title) }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Developer Logo</label>
                        @if($achievement->image)
                            <div class="mb-2">
                                <img src="{{ asset('uploads/' . $achievement->image) }}" alt="{{ $achievement->title }}"
                                     id="imgPreview" style="max-height:100px;border-radius:6px;">
                            </div>
                        @else
                            <img id="imgPreview" src="" alt="" style="display:none;margin-bottom:8px;max-height:100px;border-radius:6px;">
                        @endif
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                               accept="image/*" onchange="previewImg(this)">
                        <div class="form-text">Leave empty to keep current image. PNG recommended, max 4MB.</div>
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <hr class="my-3">
                    <p class="fw-semibold small text-muted mb-3">Project Stats</p>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">No of Units</label>
                            <input type="text" name="units" class="form-control" value="{{ old('units', $achievement->units) }}" placeholder="e.g. 107">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sales Value</label>
                            <input type="text" name="sales_value" class="form-control" value="{{ old('sales_value', $achievement->sales_value) }}" placeholder="e.g. 100 Cr.">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sold %</label>
                            <input type="text" name="sold_percentage" class="form-control" value="{{ old('sold_percentage', $achievement->sold_percentage) }}" placeholder="e.g. 98%">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Time Period</label>
                            <input type="text" name="time_period" class="form-control" value="{{ old('time_period', $achievement->time_period) }}" placeholder="e.g. 3 Months">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control" value="{{ old('location', $achievement->location) }}" placeholder="e.g. Bavdhan (PMC)">
                        </div>
                    </div>

                    <hr class="my-3">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="sort_order" class="form-control"
                                   value="{{ old('sort_order', $achievement->sort_order) }}" min="0">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label d-block">Status</label>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="is_active" value="1" id="is_active"
                                       {{ $achievement->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
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
