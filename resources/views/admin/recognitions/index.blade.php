@extends('admin.layouts.app')
@section('title', 'Recognitions & Associations')
@section('page-title', 'Recognitions & Associations')
@section('breadcrumb')
    <li class="breadcrumb-item active">Recognitions</li>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0"><i class="fas fa-award me-2" style="color:var(--primary)"></i>Recognitions & Associations</h6>
        <a href="{{ route('admin.recognitions.create') }}" class="btn btn-admin-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Add Recognition
        </a>
    </div>
    <div class="card-body p-0">
        @if($recognitions->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-award fa-3x mb-3 d-block opacity-25"></i>
                No recognitions yet. <a href="{{ route('admin.recognitions.create') }}">Add the first one.</a>
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="100">Logo</th>
                        <th>Name</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recognitions as $recognition)
                    <tr>
                        <td><img src="{{ asset('storage/' . $recognition->logo) }}" alt="{{ $recognition->name }}" style="max-height:40px;max-width:100px;object-fit:contain;"></td>
                        <td class="fw-semibold small">{{ $recognition->name }}</td>
                        <td class="small">{{ $recognition->order }}</td>
                        <td>
                            @if($recognition->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.recognitions.edit', $recognition) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.recognitions.destroy', $recognition) }}" onsubmit="return confirm('Delete?')">
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
        <div class="p-3">{{ $recognitions->links() }}</div>
        @endif
    </div>
</div>
@endsection
