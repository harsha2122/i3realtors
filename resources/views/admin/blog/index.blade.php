@extends('admin.layouts.app')
@section('title', 'Blog Posts')
@section('page-title', 'Blog Posts')
@section('breadcrumb')
    <li class="breadcrumb-item active">Blog Posts</li>
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="page-title mb-0">Blog Posts</h5>
        <small class="text-muted">{{ $posts->total() }} total posts</small>
    </div>
    <a href="{{ route('admin.blog.create') }}" class="btn btn-admin-primary">
        <i class="fas fa-plus me-1"></i> New Post
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3" style="width: 35%;">Title</th>
                        <th class="py-3">Author</th>
                        <th class="py-3">Category</th>
                        <th class="py-3">Status</th>
                        <th class="py-3">Views</th>
                        <th class="py-3">Published</th>
                        <th class="py-3 text-end px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="fw-semibold" style="max-width: 300px;">{{ $post->title }}</div>
                            <small class="text-muted">{{ $post->slug }}</small>
                        </td>
                        <td class="py-3">{{ $post->author->name ?? '-' }}</td>
                        <td class="py-3">{{ $post->category->name ?? '-' }}</td>
                        <td class="py-3">
                            @if($post->status === 'published')
                                <span class="badge bg-success">Published</span>
                            @elseif($post->status === 'archived')
                                <span class="badge bg-secondary">Archived</span>
                            @else
                                <span class="badge bg-warning text-dark">Draft</span>
                            @endif
                        </td>
                        <td class="py-3">{{ number_format($post->view_count) }}</td>
                        <td class="py-3 text-nowrap">{{ $post->published_at?->format('d M Y') ?? '-' }}</td>
                        <td class="py-3 text-end px-4">
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('admin.blog.edit', $post) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($post->status === 'draft')
                                <form action="{{ route('admin.blog.publish', $post) }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success"
                                            title="Publish" onclick="return confirm('Publish this post?')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                @endif
                                @if($post->slug)
                                <a href="{{ route('blog.show', $post->slug) }}" target="_blank"
                                   class="btn btn-sm btn-outline-secondary" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @endif
                                <form action="{{ route('admin.blog.destroy', $post) }}" method="post"
                                      class="d-inline" onsubmit="return confirm('Delete this post permanently?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fas fa-newspaper fa-2x mb-2 d-block opacity-25"></i>
                            No blog posts yet.
                            <a href="{{ route('admin.blog.create') }}">Create your first post</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($posts->hasPages())
    <div class="card-footer bg-white border-top">
        {{ $posts->links() }}
    </div>
    @endif
</div>

@endsection
