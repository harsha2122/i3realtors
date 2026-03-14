@extends('admin.layouts.app')
@section('title', 'Edit Post: ' . $post->title)
@section('page-title', 'Edit Blog Post')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Blog Posts</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

<form action="{{ route('admin.blog.update', $post) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="row g-4">

        {{-- Left: Main Content --}}
        <div class="col-xl-8">

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="postTitle" required
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $post->title) }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Slug</label>
                        <input type="text" name="slug"
                               class="form-control @error('slug') is-invalid @enderror"
                               value="{{ old('slug', $post->slug) }}">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Excerpt</label>
                        <textarea name="excerpt" rows="3"
                                  class="form-control @error('excerpt') is-invalid @enderror"
                                  placeholder="Short summary shown on listing pages">{{ old('excerpt', $post->excerpt) }}</textarea>
                        @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-semibold">Content <span class="text-danger">*</span></label>
                        <textarea id="content" name="content" required rows="18"
                                  class="form-control @error('content') is-invalid @enderror">{{ old('content', $post->content) }}</textarea>
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
                               value="{{ old('seo_title', $post->seo_title) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">SEO Description <small class="text-muted">(max 160 chars)</small></label>
                        <textarea name="seo_description" maxlength="160" rows="2" class="form-control">{{ old('seo_description', $post->seo_description) }}</textarea>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold">SEO Keywords</label>
                        <input type="text" name="seo_keywords" class="form-control"
                               value="{{ old('seo_keywords', $post->seo_keywords) }}">
                    </div>
                </div>
            </div>

        </div>

        {{-- Right: Meta --}}
        <div class="col-xl-4">

            {{-- Status & Actions --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom fw-semibold py-3">
                    <i class="fas fa-info-circle me-2 text-muted"></i>Post Status
                </div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="fw-semibold">Status</span>
                        @if($post->status === 'published')
                            <span class="badge bg-success">Published</span>
                        @elseif($post->status === 'archived')
                            <span class="badge bg-secondary">Archived</span>
                        @else
                            <span class="badge bg-warning text-dark">Draft</span>
                        @endif
                    </div>
                    @if($post->published_at)
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="fw-semibold text-muted small">Published</span>
                        <span class="small">{{ $post->published_at->format('d M Y, H:i') }}</span>
                    </div>
                    @endif
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="fas fa-save me-1"></i>Save Changes
                        </button>
                        @if($post->status === 'draft')
                            <button type="submit" name="publish_now" value="1" class="btn btn-success">
                                <i class="fas fa-check me-1"></i>Save & Publish
                            </button>
                        @endif
                        @if($post->status === 'published')
                            <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-external-link-alt me-1"></i>View Live
                            </a>
                        @endif
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
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold">Tags <small class="text-muted">(comma separated)</small></label>
                        <input type="text" name="tags" class="form-control"
                               value="{{ old('tags', $post->tags->pluck('name')->implode(', ')) }}"
                               placeholder="e.g. Investment, Mumbai, RERA">
                    </div>
                </div>
            </div>

            {{-- Featured Image --}}
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom fw-semibold py-3">
                    <i class="fas fa-image me-2 text-muted"></i>Featured Image
                </div>
                <div class="card-body p-4">
                    @if($post->featured_image)
                        <div class="mb-3">
                            <img src="{{ Storage::url($post->featured_image) }}"
                                 alt="{{ $post->title }}"
                                 class="img-fluid rounded" style="max-height: 160px;">
                            <div class="mt-2">
                                <small class="text-muted">Current image. Upload a new one to replace it.</small>
                            </div>
                        </div>
                    @endif
                    <input type="file" name="featured_image" accept="image/*"
                           class="form-control @error('featured_image') is-invalid @enderror"
                           onchange="previewFeaturedImage(this)">
                    @error('featured_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="imagePreview" class="mt-3 d-none">
                        <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height: 160px;">
                    </div>
                    <small class="text-muted d-block mt-2">Recommended: 1200×630px, JPG or PNG</small>
                </div>
            </div>

        </div>
    </div>
</form>

@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#content',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 500,
        license_key: 'gpl',
        skin: 'oxide',
        content_css: 'default'
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
