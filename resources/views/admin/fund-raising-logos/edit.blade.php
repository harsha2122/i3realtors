@extends('admin.layouts.app')
@section('title', 'Replace Logo')
@section('page-title', 'Replace Logo')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.fund-raising-logos.index') }}">Fund Raising Logos</a></li>
    <li class="breadcrumb-item active">Replace</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-4 pb-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-sync-alt me-2" style="color:var(--primary)"></i>Replace Logo</h6>
            </div>
            <div class="card-body">
                <div class="mb-4 text-center">
                    <p class="text-muted small mb-2">Current logo</p>
                    <div style="display:inline-flex; align-items:center; justify-content:center; width:160px; height:160px; border:1px solid #e9ecef; border-radius:10px; background:#f9f9f9; padding:16px;">
                        <img src="{{ asset('uploads/' . $fundRaisingLogo->logo) }}" id="currentImg"
                             style="max-width:100%; max-height:100%; object-fit:contain;">
                    </div>
                </div>

                <form action="{{ route('admin.fund-raising-logos.update', $fundRaisingLogo) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-4">
                        <label class="form-label fw-semibold">New Logo Image <span class="text-danger">*</span></label>
                        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror"
                               accept="image/*" required onchange="previewNew(this)">
                        <div class="form-text">PNG recommended. Max 2MB.</div>
                        @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <img id="newPreview" src="" style="display:none; margin-top:10px; max-height:100px; border:1px solid #dee2e6; border-radius:8px; padding:8px; background:#fff;">
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i>Save</button>
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
function previewNew(input) {
    const preview = document.getElementById('newPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
