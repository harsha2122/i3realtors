@extends('admin.layouts.app')
@section('title', 'Create Blog Post')
@section('page-title', 'Create Blog Post')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Blog Posts</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

<form action="{{ route('admin.blog.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="row g-4">

        {{-- Left: Main Content --}}
        <div class="col-xl-8">

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="postTitle" required
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}" placeholder="Enter post title">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Slug</label>
                        <input type="text" name="slug" id="postSlug"
                               class="form-control @error('slug') is-invalid @enderror"
                               value="{{ old('slug') }}" placeholder="auto-generated-from-title">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Excerpt</label>
                        <textarea name="excerpt" rows="3"
                                  class="form-control @error('excerpt') is-invalid @enderror"
                                  placeholder="Short summary shown on listing pages (optional)">{{ old('excerpt') }}</textarea>
                        @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-semibold">Content <span class="text-danger">*</span></label>
                        <textarea id="content" name="content" required rows="18"
                                  class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- SEO --}}
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom fw-semibold py-3">
                    <i class="fas fa-search me-2 text-muted"></i>SEO Settings
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">SEO Title <small class="text-muted">(max 60 chars)</small></label>
                        <input type="text" name="seo_title" maxlength="60" class="form-control"
                               value="{{ old('seo_title') }}" placeholder="Defaults to post title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">SEO Description <small class="text-muted">(max 160 chars)</small></label>
                        <textarea name="seo_description" maxlength="160" rows="2" class="form-control"
                                  placeholder="Defaults to excerpt">{{ old('seo_description') }}</textarea>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold">SEO Keywords</label>
                        <input type="text" name="seo_keywords" class="form-control"
                               value="{{ old('seo_keywords') }}" placeholder="Comma separated keywords">
                    </div>
                </div>
            </div>

        </div>

        {{-- Right: Meta --}}
        <div class="col-xl-4">

            {{-- Publish --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom fw-semibold py-3">
                    <i class="fas fa-paper-plane me-2 text-muted"></i>Publish
                </div>
                <div class="card-body p-4">
                    <p class="text-muted small mb-3">Post will be saved as <strong>Draft</strong>. You can publish it from the edit screen.</p>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary flex-fill">
                            <i class="fas fa-save me-1"></i>Save Draft
                        </button>
                        <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>

            {{-- Category & Tags --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom fw-semibold py-3">
                    <i class="fas fa-tags me-2 text-muted"></i>Category & Tags
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Category</label>
                        <select name="category_id" class="form-select">
                            <option value="">— No Category —</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold">Tags <small class="text-muted">(comma separated)</small></label>
                        <input type="text" name="tags" class="form-control"
                               value="{{ old('tags') }}" placeholder="e.g. Investment, Mumbai, RERA">
                    </div>
                </div>
            </div>

            {{-- Featured Image --}}
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom fw-semibold py-3">
                    <i class="fas fa-image me-2 text-muted"></i>Featured Image
                </div>
                <div class="card-body p-4">
                    <input type="file" name="featured_image" accept="image/*"
                           class="form-control @error('featured_image') is-invalid @enderror"
                           onchange="previewFeaturedImage(this)">
                    @error('featured_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="imagePreview" class="mt-3 d-none">
                        <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                    </div>
                    <small class="text-muted d-block mt-2">Recommended: 1200×630px, JPG or PNG</small>
                </div>
            </div>

        </div>
    </div>
</form>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.24.6/jodit.min.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.24.6/jodit.min.js"></script>
<script>
    Jodit.make('#content', {
        height: 500,
        buttons: 'bold,italic,underline,strikethrough,|,ul,ol,|,font,fontsize,|,image,link,table,|,align,|,undo,redo,|,source',
        uploader: { insertImageAsBase64URI: true },
    });

    // Auto-generate slug from title
    document.getElementById('postTitle').addEventListener('input', function () {
        const slug = this.value.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim();
        document.getElementById('postSlug').value = slug;
    });

    function previewFeaturedImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
