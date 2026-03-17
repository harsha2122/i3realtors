@extends('admin.layouts.app')

@section('title', 'Projects')
@section('page-title', 'Projects')
@section('breadcrumb')
    <li class="breadcrumb-item active">Projects</li>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="fw-bold mb-0"><i class="fas fa-city me-2" style="color:var(--primary)"></i>All Projects</h6>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-admin-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Add Project
        </a>
    </div>

    {{-- Filters --}}
    <div class="card-body border-bottom pb-3 pt-0">
        <form method="GET" action="{{ route('admin.projects.index') }}" class="row g-2 align-items-end">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ $filters['search'] ?? '' }}"
                       class="form-control form-control-sm" placeholder="Search title, location…" />
            </div>
            <div class="col-md-2">
                <select name="type" class="form-select form-select-sm">
                    <option value="">All Types</option>
                    @foreach(['residential','commercial','industrial','infrastructure','mixed_use'] as $t)
                        <option value="{{ $t }}" {{ ($filters['type'] ?? '') === $t ? 'selected' : '' }}>{{ ucwords(str_replace('_',' ',$t)) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    <option value="upcoming"  {{ ($filters['status'] ?? '') === 'upcoming'  ? 'selected' : '' }}>Upcoming</option>
                    <option value="ongoing"   {{ ($filters['status'] ?? '') === 'ongoing'   ? 'selected' : '' }}>Ongoing</option>
                    <option value="completed" {{ ($filters['status'] ?? '') === 'completed' ? 'selected' : '' }}>Completed</option>
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
                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
            </div>
        </form>
    </div>

    <div class="card-body p-0">
        @if($projects->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-city fa-3x mb-3 d-block opacity-25"></i>
                No projects found. <a href="{{ route('admin.projects.create') }}">Add the first one.</a>
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="60">Thumb</th>
                        <th>Title / Location</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Active</th>
                        <th>Featured</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td>
                            <img src="{{ $project->thumbnail_url }}" alt=""
                                 class="rounded" style="width:50px;height:40px;object-fit:cover;" />
                        </td>
                        <td>
                            <div class="fw-semibold small">{{ $project->title }}</div>
                            @if($project->city)
                            <div class="text-muted" style="font-size:0.78rem;">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ $project->city }}{{ $project->state ? ', '.$project->state : '' }}
                            </div>
                            @endif
                        </td>
                        <td><span class="badge bg-light text-dark border">{{ $project->type_label }}</span></td>
                        <td>
                            <span class="badge bg-{{ $project->status_badge }}">{{ $project->status_label }}</span>
                        </td>
                        <td>
                            @if($project->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td>
                            @if($project->is_featured)
                                <i class="fas fa-star text-warning"></i>
                            @else
                                <i class="far fa-star text-muted"></i>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.projects.edit', $project->id) }}"
                                   class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('website.projects.show', $project->slug) }}" target="_blank"
                                   class="btn btn-sm btn-outline-secondary" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.projects.destroy', $project->id) }}"
                                      onsubmit="return confirm('Delete this project? This cannot be undone.')">
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
        <div class="p-3">{{ $projects->withQueryString()->links() }}</div>
        @endif
    </div>
</div>
@endsection
