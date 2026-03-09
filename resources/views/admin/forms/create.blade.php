@extends('admin.layouts.app')

@section('title', 'Create Form')
@section('page-title', 'Create Form')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.forms.index') }}">Forms</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-4 pb-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-plus me-2" style="color:var(--primary)"></i>New Form</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.forms.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Form Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required placeholder="e.g. contact-form">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label">Display Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required placeholder="e.g. Contact Us">
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="success_message" class="form-label">Success Message</label>
                        <input type="text" class="form-control" id="success_message" name="success_message" value="{{ old('success_message') }}" placeholder="Thank you for your submission!">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="redirect_url" class="form-label">Redirect URL</label>
                            <input type="url" class="form-control @error('redirect_url') is-invalid @enderror" id="redirect_url" name="redirect_url" value="{{ old('redirect_url') }}" placeholder="https://...">
                            @error('redirect_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="notification_email" class="form-label">Notification Email</label>
                            <input type="email" class="form-control @error('notification_email') is-invalid @enderror" id="notification_email" name="notification_email" value="{{ old('notification_email') }}">
                            @error('notification_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i>Create Form</button>
                        <a href="{{ route('admin.forms.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
