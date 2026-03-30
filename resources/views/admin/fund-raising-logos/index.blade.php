@extends('admin.layouts.app')
@section('title', 'Fund Raising Logos')
@section('page-title', 'Fund Raising Logos')
@section('breadcrumb')
    <li class="breadcrumb-item active">Fund Raising Logos</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.fund-raising-logos.create') }}" class="btn btn-admin-primary">
        <i class="fas fa-plus me-2"></i>Add Logo
    </a>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-0">
        @if($logos->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-image fa-3x mb-3 d-block"></i>
                No logos yet. <a href="{{ route('admin.fund-raising-logos.create') }}">Add one</a>.
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logos as $logo)
                    <tr>
                        <td class="ps-4 text-muted small">{{ $logo->id }}</td>
                        <td>
                            <div style="width:100px; height:60px; border:1px solid #e9ecef; border-radius:6px; overflow:hidden; background:#fff; display:flex; align-items:center; justify-content:center; padding:6px;">
                                <img src="{{ asset('uploads/' . $logo->logo) }}" alt="{{ $logo->name }}"
                                     style="max-width:100%; max-height:100%; object-fit:contain;">
                            </div>
                        </td>
                        <td class="fw-semibold">{{ $logo->name }}</td>
                        <td>{{ $logo->sort_order }}</td>
                        <td>
                            <span class="badge {{ $logo->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $logo->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.fund-raising-logos.edit', $logo) }}" class="btn btn-sm btn-outline-secondary me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.fund-raising-logos.destroy', $logo) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this logo?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
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
