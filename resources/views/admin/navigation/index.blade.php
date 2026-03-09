@extends('admin.layouts.app')

@section('title', 'Navigation Menus')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Navigation Menus</h1>
        <a href="{{ route('admin.navigation.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Create Menu
        </a>
    </div>

    @if($menus->isEmpty())
        <div class="alert alert-info">
            <i class="fa-solid fa-info-circle"></i> No navigation menus found.
            <a href="{{ route('admin.navigation.create') }}">Create the first one</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Position</th>
                        <th>Items</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $menu)
                        <tr>
                            <td>
                                <strong>{{ $menu->name }}</strong>
                            </td>
                            <td>
                                <code>{{ $menu->slug }}</code>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ ucfirst($menu->position) }}</span>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $menu->items_count ?? $menu->items->count() }}</span>
                            </td>
                            <td>
                                @if($menu->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('admin.navigation.edit', $menu) }}" class="btn btn-outline-primary" title="Edit">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.navigation.preview', $menu) }}" class="btn btn-outline-info" title="Preview" target="_blank">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.navigation.export', $menu) }}" class="btn btn-outline-secondary" title="Export">
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                    <form action="{{ route('admin.navigation.duplicate', $menu) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-warning" title="Duplicate">
                                            <i class="fa-solid fa-clone"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.navigation.destroy', $menu) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $menus->links() }}
    @endif
</div>
@endsection
