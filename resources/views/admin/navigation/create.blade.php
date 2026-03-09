@extends('admin.layouts.app')

@section('title', 'Create Navigation Menu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Create New Navigation Menu</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.navigation.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Menu Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="e.g., Main Header Menu" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" placeholder="e.g., main-header-menu" required>
                            <small class="form-text text-muted">URL-friendly identifier (lowercase, numbers, and hyphens only)</small>
                            @error('slug')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="position" class="form-label">Position <span class="text-danger">*</span></label>
                            <select class="form-select @error('position') is-invalid @enderror" id="position" name="position" required>
                                <option value="">Select position</option>
                                <option value="header" {{ old('position') == 'header' ? 'selected' : '' }}>Header</option>
                                <option value="footer" {{ old('position') == 'footer' ? 'selected' : '' }}>Footer</option>
                                <option value="mobile" {{ old('position') == 'mobile' ? 'selected' : '' }}>Mobile</option>
                                <option value="custom" {{ old('position') == 'custom' ? 'selected' : '' }}>Custom</option>
                            </select>
                            @error('position')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Optional description for this menu">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active (menu will be displayed)
                            </label>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-save"></i> Create Menu
                            </button>
                            <a href="{{ route('admin.navigation.index') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-header">
                    <h6 class="mb-0">Help</h6>
                </div>
                <div class="card-body">
                    <p><strong>Menu Name:</strong> Human-readable name for this menu (e.g., "Main Navigation")</p>
                    <p><strong>Slug:</strong> Unique identifier used in code (e.g., "main-nav")</p>
                    <p><strong>Position:</strong> Where this menu will appear on the website</p>
                    <p>After creating the menu, you'll be able to add menu items to it.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto-generate slug from name
    document.getElementById('name').addEventListener('input', function() {
        const slug = this.value
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        document.getElementById('slug').value = slug;
    });
</script>
@endsection
