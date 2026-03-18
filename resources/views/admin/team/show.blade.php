@extends('admin.layouts.app')

@section('title', $member->first_name . ' ' . $member->last_name)
@section('page-title', 'Team Member')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.team.index') }}">Team</a></li>
    <li class="breadcrumb-item active">{{ $member->first_name }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-3 text-center">
            <div class="card-body py-4">
                @if($member->profile_image)
                    <img src="{{ asset('uploads/' . $member->profile_image) }}" alt="" class="rounded-circle mb-3" style="width:120px;height:120px;object-fit:cover;">
                @else
                    <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3" style="width:120px;height:120px;">
                        <i class="fas fa-user fa-3x text-muted"></i>
                    </div>
                @endif
                <h5 class="fw-bold mb-1">{{ $member->first_name }} {{ $member->last_name }}</h5>
                <p class="text-muted mb-1">{{ $member->position }}</p>
                @if($member->department)
                    <span class="badge bg-light text-dark border">{{ $member->department }}</span>
                @endif

                <hr>
                <div class="text-start small">
                    @if($member->email)
                        <p><i class="fas fa-envelope me-2 text-muted"></i>{{ $member->email }}</p>
                    @endif
                    @if($member->phone)
                        <p><i class="fas fa-phone me-2 text-muted"></i>{{ $member->phone }}</p>
                    @endif
                    @if($member->joining_date)
                        <p><i class="fas fa-calendar me-2 text-muted"></i>Joined {{ \Carbon\Carbon::parse($member->joining_date)->format('M d, Y') }}</p>
                    @endif
                </div>

                <div class="d-flex gap-2 justify-content-center mt-3">
                    <a href="{{ route('admin.team.edit', $member) }}" class="btn btn-admin-primary btn-sm"><i class="fas fa-edit me-1"></i>Edit</a>
                    <form method="POST" action="{{ route('admin.team.destroy', $member) }}" onsubmit="return confirm('Delete this member?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash me-1"></i>Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        @if($member->bio)
        <div class="card border-0 shadow-sm rounded-3 mb-3">
            <div class="card-header bg-white border-0 pt-4 pb-2">
                <h6 class="fw-bold mb-0">Bio</h6>
            </div>
            <div class="card-body pt-0">
                <p>{{ $member->bio }}</p>
            </div>
        </div>
        @endif

        @if($member->skills && $member->skills->count())
        <div class="card border-0 shadow-sm rounded-3 mb-3">
            <div class="card-header bg-white border-0 pt-4 pb-2">
                <h6 class="fw-bold mb-0">Skills</h6>
            </div>
            <div class="card-body pt-0">
                @foreach($member->skills as $skill)
                    <span class="badge bg-primary me-1 mb-1">{{ $skill->name }}</span>
                @endforeach
            </div>
        </div>
        @endif

        @if($member->socials && $member->socials->count())
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-4 pb-2">
                <h6 class="fw-bold mb-0">Social Links</h6>
            </div>
            <div class="card-body pt-0">
                @foreach($member->socials as $social)
                    <a href="{{ $social->url }}" target="_blank" class="btn btn-sm btn-outline-secondary me-1">
                        <i class="{{ $social->icon ?? 'fas fa-link' }} me-1"></i>{{ $social->platform ?? $social->url }}
                    </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
