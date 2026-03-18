@extends('admin.layouts.app')
@section('title', 'Edit Recognition')
@section('page-title', 'Edit Recognition')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.recognitions.index') }}">Recognitions</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-4 pb-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-edit me-2" style="color:var(--primary)"></i>Edit: {{ $recognition->name }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.recognitions.update', $recognition) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $recognition->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo Image</label>
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $recognition->logo) }}" alt="{{ $recognition->name }}" style="max-height:60px;max-width:150px;object-fit:contain;background:#f8f9fa;padding:8px;border-radius:4px;">
                        </div>
                        <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*">
                        <div class="form-text">Leave blank to keep current logo.</div>
                        @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="order" class="form-label">Display Order</label>
                            <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $recognition->order) }}" min="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label d-block">Status</label>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $recognition->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active (show on website)</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i>Update</button>
                        <a href="{{ route('admin.recognitions.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
