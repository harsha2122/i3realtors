@extends('admin.layouts.app')

@section('title', 'Properties')
@section('page-title', 'Properties')
@section('breadcrumb')
    <li class="breadcrumb-item active">Properties</li>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="fw-bold mb-0"><i class="fas fa-building me-2" style="color:var(--primary)"></i>All Properties</h6>
        <a href="{{ route('admin.properties.create') }}" class="btn btn-admin-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Add Property
        </a>
    </div>

    {{-- Filters --}}
    <div class="card-body border-bottom pb-3 pt-0">
        <form method="GET" action="{{ route('admin.properties.index') }}" class="row g-2 align-items-end">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ $filters['search'] ?? '' }}"
                       class="form-control form-control-sm" placeholder="Search title, location…" />
            </div>
            <div class="col-md-2">
                <select name="type" class="form-select form-select-sm">
                    <option value="">All Types</option>
                    @foreach(['residential','commercial','industrial','infrastructure','plot'] as $t)
                        <option value="{{ $t }}" {{ ($filters['type'] ?? '') === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    @foreach(['available','sold','under_construction','coming_soon'] as $s)
                        <option value="{{ $s }}" {{ ($filters['status'] ?? '') === $s ? 'selected' : '' }}>{{ ucwords(str_replace('_',' ',$s)) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="is_active" class="form-select form-select-sm">
                    <option value="">All</option>
                    <option value="1" {{ isset($filters['is_active']) && $filters['is_active'] === '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ isset($filters['is_active']) && $filters['is_active'] === '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-admin-primary btn-sm flex-fill">Filter</button>
                <a href="{{ route('admin.properties.index') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
            </div>
        </form>
    </div>

    <div class="card-body p-0">
        @if($properties->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-building fa-3x mb-3 d-block opacity-25"></i>
                No properties found. <a href="{{ route('admin.properties.create') }}">Add the first one.</a>
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="60">Thumb</th>
                        <th>Title / Location</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Active</th>
                        <th>Featured</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($properties as $property)
                    <tr>
                        <td>
                            <img src="{{ $property->thumbnail_url }}" alt=""
                                 class="rounded" style="width:50px;height:40px;object-fit:cover;" />
                        </td>
                        <td>
                            <div class="fw-semibold small">{{ $property->title }}</div>
                            @if($property->city)
                            <div class="text-muted" style="font-size:0.78rem;">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ $property->city }}{{ $property->state ? ', '.$property->state : '' }}
                            </div>
                            @endif
                        </td>
                        <td><span class="badge bg-light text-dark border">{{ $property->type_label }}</span></td>
                        <td class="small fw-semibold">{{ $property->formatted_price }}</td>
                        <td>
                            <span class="badge bg-{{ $property->status_badge }}">{{ $property->status_label }}</span>
                        </td>
                        <td>
                            @if($property->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td>
                            @if($property->is_featured)
                                <i class="fas fa-star text-warning"></i>
                            @else
                                <i class="far fa-star text-muted"></i>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.properties.edit', $property->id) }}"
                                   class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('projects.show', $property->slug) }}" target="_blank"
                                   class="btn btn-sm btn-outline-secondary" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.properties.destroy', $property->id) }}"
                                      onsubmit="return confirm('Delete this property? This cannot be undone.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $properties->withQueryString()->links() }}</div>
        @endif
    </div>
</div>
@endsection
