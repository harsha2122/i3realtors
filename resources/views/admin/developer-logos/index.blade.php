@extends('admin.layouts.app')
@section('title', 'Developer Logos')
@section('page-title', 'Developer Logos')
@section('breadcrumb')
    <li class="breadcrumb-item active">Developer Logos</li>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0"><i class="fas fa-building me-2" style="color:var(--primary)"></i>Trusted Developer Logos</h6>
        <a href="{{ route('admin.developer-logos.create') }}" class="btn btn-admin-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Add Logo
        </a>
    </div>
    <div class="card-body p-0">
        @if($logos->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-building fa-3x mb-3 d-block opacity-25"></i>
                No developer logos yet. <a href="{{ route('admin.developer-logos.create') }}">Add the first one.</a>
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="80">Logo</th>
                        <th>Name</th>
                        <th>Link</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logos as $logo)
                    <tr>
                        <td><img src="{{ asset('storage/' . $logo->logo) }}" alt="{{ $logo->name }}" style="max-height:40px;max-width:80px;object-fit:contain;"></td>
                        <td class="fw-semibold small">{{ $logo->name }}</td>
                        <td class="small text-muted">{{ $logo->link ?? '—' }}</td>
                        <td class="small">{{ $logo->order }}</td>
                        <td>
                            @if($logo->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.developer-logos.edit', $logo) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.developer-logos.destroy', $logo) }}" onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $logos->links() }}</div>
        @endif
    </div>
</div>
@endsection
