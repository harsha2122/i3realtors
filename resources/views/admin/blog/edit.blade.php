@extends('admin.layouts.app')

@section('title', 'Edit Blog Post')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-3xl font-bold mb-6">Edit Blog Post</h1>

    <form action="{{ route('admin.blog.update', $post) }}" method="post" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 space-y-6">
        @csrf
        @method('put')

        <div class="flex justify-between items-center mb-6">
            <div>
                <span class="inline-block px-3 py-1 rounded-full {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ ucfirst($post->status) }}
                </span>
            </div>
            @if($post->status === 'draft')
                <form action="{{ route('admin.blog.publish', $post) }}" method="post" class="inline">
                    @csrf
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold">
                        Publish
                    </button>
                </form>
            @endif
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
            <input type="text" name="title" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('title') border-red-500 @enderror"
                value="{{ old('title', $post->title) }}">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                <input type="text" name="slug"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('slug') border-red-500 @enderror"
                    value="{{ old('slug', $post->slug) }}">
                @error('slug')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                <select name="category_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
            @if($post->featured_image)
                <div class="mb-4">
                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="h-32 rounded">
                </div>
            @endif
            <input type="file" name="featured_image" accept="image/*"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('featured_image') border-red-500 @enderror">
            @error('featured_image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
            <textarea name="excerpt" rows="3"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('excerpt') border-red-500 @enderror"
                placeholder="Brief summary of the post">{{ old('excerpt', $post->excerpt) }}</textarea>
            @error('excerpt')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
            <textarea id="content" name="content" required rows="15"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('content') border-red-500 @enderror">{{ old('content', $post->content) }}</textarea>
            @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">SEO Title</label>
                <input type="text" name="seo_title" maxlength="60"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    value="{{ old('seo_title', $post->seo_title) }}" placeholder="Max 60 chars">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">SEO Description</label>
                <textarea name="seo_description" maxlength="160" rows="2"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    placeholder="Max 160 chars">{{ old('seo_description', $post->seo_description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">SEO Keywords</label>
                <input type="text" name="seo_keywords"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    value="{{ old('seo_keywords', $post->seo_keywords) }}" placeholder="Comma separated">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
            <input type="text" name="tags"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                value="{{ old('tags', $post->tags->pluck('name')->join(', ')) }}"
                placeholder="Comma separated">
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold">
                Save Changes
            </button>
            <a href="{{ route('admin.blog.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg font-semibold">
                Cancel
            </a>
        </div>
    </form>
</div>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#content',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 500,
        license_key: 'gpl'
    });
</script>
@endsection
