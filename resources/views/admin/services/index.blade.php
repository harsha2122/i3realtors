@extends('admin.layouts.app')

@section('title', 'Services')
@section('page-title', 'Services')
@section('breadcrumb')
    <li class="breadcrumb-item active">Services</li>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0"><i class="fas fa-cogs me-2" style="color:var(--primary)"></i>All Services</h6>
        <a href="{{ route('admin.services.create') }}" class="btn btn-admin-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Add Service
        </a>
    </div>

    <div class="card-body p-0">
        @if($services->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-cogs fa-3x mb-3 d-block opacity-25"></i>
                No services found. <a href="{{ route('admin.services.create') }}">Add the first one.</a>
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="60">Image</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Category</th>
                        <th>Created</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>
                            @if($service->featured_image)
                                <img src="{{ asset('uploads/' . $service->featured_image) }}" alt="" class="rounded" style="width:50px;height:40px;object-fit:cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:50px;height:40px;">
                                    <i class="{{ $service->icon ?? 'fas fa-cog' }} text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-semibold small">{{ $service->title }}</td>
                        <td><code class="small">{{ $service->slug }}</code></td>
                        <td class="small text-muted">{{ $service->category ?? '-' }}</td>
                        <td class="small text-muted">{{ $service->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Delete this service?')">
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
        <div class="p-3">{{ $services->links() }}</div>
        @endif
    </div>
</div>
@endsection
