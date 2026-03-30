@extends('admin.layouts.app')
@section('title', 'Achievements')
@section('page-title', 'Achievements')
@section('breadcrumb')
    <li class="breadcrumb-item active">Achievements</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.achievements.create') }}" class="btn btn-admin-primary">
        <i class="fas fa-plus me-2"></i>Add Achievement
    </a>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-0">
        @if($achievements->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-trophy fa-3x mb-3 d-block"></i>
                No achievements yet. <a href="{{ route('admin.achievements.create') }}">Add one</a>.
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($achievements as $achievement)
                    <tr>
                        <td class="ps-4 text-muted small">{{ $achievement->id }}</td>
                        <td>
                            @if($achievement->image)
                                <img src="{{ asset('uploads/' . $achievement->image) }}" alt="{{ $achievement->title }}"
                                     style="width:60px; height:50px; object-fit:cover; border-radius:6px;">
                            @else
                                <div style="width:60px;height:50px;background:#f0f0f0;border-radius:6px;display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $achievement->title }}</td>
                        <td class="text-muted small">{{ $achievement->subtitle }}</td>
                        <td>{{ $achievement->sort_order }}</td>
                        <td>
                            <span class="badge {{ $achievement->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $achievement->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.achievements.edit', $achievement) }}" class="btn btn-sm btn-outline-secondary me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.achievements.destroy', $achievement) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this achievement?')">
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
        <div class="p-3">
            {{ $achievements->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
