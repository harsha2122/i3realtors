@extends('admin.layouts.app')

@section('title', 'Forms')
@section('page-title', 'Form Builder')
@section('breadcrumb')
    <li class="breadcrumb-item active">Forms</li>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0"><i class="fas fa-wpforms me-2" style="color:var(--primary)"></i>All Forms</h6>
        <a href="{{ route('admin.forms.create') }}" class="btn btn-admin-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Create Form
        </a>
    </div>

    <div class="card-body p-0">
        @if($forms->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-wpforms fa-3x mb-3 d-block opacity-25"></i>
                No forms yet. <a href="{{ route('admin.forms.create') }}">Create the first one.</a>
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Fields</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th width="180">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($forms as $form)
                    <tr>
                        <td class="fw-semibold small">{{ $form->name }}</td>
                        <td class="small">{{ $form->title }}</td>
                        <td><span class="badge bg-info">{{ $form->fields->count() }} fields</span></td>
                        <td>
                            @if($form->is_active ?? true)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td class="small text-muted">{{ $form->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.forms.edit', $form) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('admin.forms.submissions', $form) }}" class="btn btn-sm btn-outline-info" title="Submissions"><i class="fas fa-inbox"></i></a>
                                <a href="{{ route('admin.forms.exportSubmissions', $form) }}" class="btn btn-sm btn-outline-secondary" title="Export"><i class="fas fa-download"></i></a>
                                <form method="POST" action="{{ route('admin.forms.destroy', $form) }}" onsubmit="return confirm('Delete this form?')">
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
        <div class="p-3">{{ $forms->links() }}</div>
        @endif
    </div>
</div>
@endsection
