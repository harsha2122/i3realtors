@extends('admin.layouts.app')

@section('title', 'Categories')
@section('page-title', 'Categories')
@section('breadcrumb')
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0"><i class="fas fa-tags me-2" style="color:var(--primary)"></i>All Categories</h6>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-admin-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Add Category
        </a>
    </div>

    <div class="card-body p-0">
        @if($categories->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-tags fa-3x mb-3 d-block opacity-25"></i>
                No categories found. <a href="{{ route('admin.categories.create') }}">Add the first one.</a>
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Posts</th>
                        <th>Created</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>
                            <div class="fw-semibold small">
                                @if($category->icon)<i class="{{ $category->icon }} me-1"></i>@endif
                                {{ $category->name }}
                            </div>
                        </td>
                        <td><code class="small">{{ $category->slug }}</code></td>
                        <td><span class="badge bg-info">{{ $category->posts_count ?? $category->posts()->count() }}</span></td>
                        <td class="small text-muted">{{ $category->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Delete this category?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $categories->links() }}</div>
        @endif
    </div>
</div>
@endsection
