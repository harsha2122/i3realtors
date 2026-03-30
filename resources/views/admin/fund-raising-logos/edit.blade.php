@extends('admin.layouts.app')
@section('title', 'Edit Fund Raising Logo')
@section('page-title', 'Edit Logo')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.fund-raising-logos.index') }}">Fund Raising Logos</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-4 pb-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-edit me-2" style="color:var(--primary)"></i>Edit Clientele Logo</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.fund-raising-logos.update', $fundRaisingLogo) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $fundRaisingLogo->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Logo Image</label>
                        <div class="mb-2">
                            <img src="{{ asset('uploads/' . $fundRaisingLogo->logo) }}" alt="{{ $fundRaisingLogo->name }}"
                                 id="imgPreview" style="max-height:80px; border:1px solid #dee2e6; border-radius:6px; padding:6px; background:#fff;">
                        </div>
                        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror"
                               accept="image/*" onchange="previewImg(this)">
                        <div class="form-text">Leave empty to keep current logo. PNG recommended. Max 2MB.</div>
                        @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="sort_order" class="form-control"
                                   value="{{ old('sort_order', $fundRaisingLogo->sort_order) }}" min="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label d-block">Status</label>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="is_active" value="1" id="is_active"
                                       {{ $fundRaisingLogo->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i>Update</button>
                        <a href="{{ route('admin.fund-raising-logos.index') }}" class="btn btn-outline-secondary">Cancel</a>
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
