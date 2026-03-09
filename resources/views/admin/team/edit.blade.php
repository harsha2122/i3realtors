@extends('admin.layouts.app')

@section('title', 'Edit Team Member')
@section('page-title', 'Edit Team Member')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.team.index') }}">Team</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-4 pb-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-user-edit me-2" style="color:var(--primary)"></i>Edit: {{ $member->first_name }} {{ $member->last_name }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.team.update', $member) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', $member->first_name) }}" required>
                            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $member->last_name) }}" required>
                            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="position" class="form-label">Position <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position" value="{{ old('position', $member->position) }}" required>
                            @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="department" class="form-label">Department</label>
                            <input type="text" class="form-control" id="department" name="department" value="{{ old('department', $member->department) }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $member->email) }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $member->phone) }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control" id="bio" name="bio" rows="4">{{ old('bio', $member->bio) }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="profile_image" class="form-label">Profile Image</label>
                            @if($member->profile_image)
                                <div class="mb-2"><img src="{{ asset('storage/' . $member->profile_image) }}" alt="" class="rounded" style="max-height:80px;"></div>
                            @endif
                            <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="joining_date" class="form-label">Joining Date</label>
                            <input type="date" class="form-control" id="joining_date" name="joining_date" value="{{ old('joining_date', $member->joining_date) }}">
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i>Update</button>
                        <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
