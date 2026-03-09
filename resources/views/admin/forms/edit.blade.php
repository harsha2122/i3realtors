@extends('admin.layouts.app')

@section('title', 'Edit Form: ' . $form->name)
@section('page-title', 'Edit Form')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.forms.index') }}">Forms</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row">
    {{-- Form Settings --}}
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-3 mb-3">
            <div class="card-header bg-white border-0 pt-4 pb-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-cog me-2" style="color:var(--primary)"></i>Form Settings</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.forms.update', $form) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Form Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $form->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Display Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $form->title) }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="2">{{ old('description', $form->description) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="success_message" class="form-label">Success Message</label>
                        <input type="text" class="form-control" id="success_message" name="success_message" value="{{ old('success_message', $form->success_message) }}">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="redirect_url" class="form-label">Redirect URL</label>
                            <input type="url" class="form-control" id="redirect_url" name="redirect_url" value="{{ old('redirect_url', $form->redirect_url) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="notification_email" class="form-label">Notification Email</label>
                            <input type="email" class="form-control" id="notification_email" name="notification_email" value="{{ old('notification_email', $form->notification_email) }}">
                        </div>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $form->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                    <button type="submit" class="btn btn-admin-primary btn-sm w-100"><i class="fas fa-save me-1"></i>Update Settings</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Form Fields --}}
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-3 mb-3">
            <div class="card-header bg-white border-0 pt-4 pb-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-list me-2" style="color:var(--primary)"></i>Form Fields</h6>
            </div>
            <div class="card-body p-0">
                @if($form->fields->isEmpty())
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-list fa-2x mb-2 d-block opacity-25"></i>
                        No fields yet. Add one below.
                    </div>
                @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Label</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Required</th>
                                <th width="80">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($form->fields->sortBy('order') as $field)
                            <tr>
                                <td class="small fw-semibold">{{ $field->label }}</td>
                                <td><code class="small">{{ $field->name }}</code></td>
                                <td><span class="badge bg-light text-dark border">{{ $field->type }}</span></td>
                                <td>
                                    @if($field->required)
                                        <i class="fas fa-check text-success"></i>
                                    @else
                                        <i class="fas fa-minus text-muted"></i>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('admin.forms.deleteField', $field) }}" onsubmit="return confirm('Delete this field?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>

        {{-- Add Field --}}
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-4 pb-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-plus me-2" style="color:var(--primary)"></i>Add Field</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.forms.addField', $form) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="field_label" class="form-label">Label <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="field_label" name="label" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="field_name" class="form-label">Field Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="field_name" name="name" required placeholder="e.g. full_name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="field_type" class="form-label">Type <span class="text-danger">*</span></label>
                            <select class="form-select" id="field_type" name="type" required>
                                <option value="text">Text</option>
                                <option value="email">Email</option>
                                <option value="phone">Phone</option>
                                <option value="textarea">Textarea</option>
                                <option value="select">Select</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="radio">Radio</option>
                                <option value="date">Date</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="field_placeholder" class="form-label">Placeholder</label>
                            <input type="text" class="form-control" id="field_placeholder" name="placeholder">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label d-block">Options</label>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" id="field_required" name="required" value="1">
                                <label class="form-check-label" for="field_required">Required</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3" id="options-container" style="display:none;">
                        <label for="field_options" class="form-label">Options (JSON array)</label>
                        <textarea class="form-control" id="field_options" name="options" rows="2" placeholder='["Option 1", "Option 2", "Option 3"]'></textarea>
                    </div>
                    <button type="submit" class="btn btn-admin-primary btn-sm"><i class="fas fa-plus me-1"></i>Add Field</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('field_label').addEventListener('input', function() {
    document.getElementById('field_name').value = this.value.toLowerCase().replace(/[^\w\s]/g, '').replace(/\s+/g, '_');
});
document.getElementById('field_type').addEventListener('change', function() {
    document.getElementById('options-container').style.display = ['select', 'radio', 'checkbox'].includes(this.value) ? 'block' : 'none';
});
</script>
@endsection
