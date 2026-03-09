@extends('admin.layouts.app')

@section('title', 'Team Members')
@section('page-title', 'Team Members')
@section('breadcrumb')
    <li class="breadcrumb-item active">Team</li>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0"><i class="fas fa-users me-2" style="color:var(--primary)"></i>Team Members</h6>
        <a href="{{ route('admin.team.create') }}" class="btn btn-admin-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Add Member
        </a>
    </div>

    <div class="card-body p-0">
        @if($members->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-users fa-3x mb-3 d-block opacity-25"></i>
                No team members. <a href="{{ route('admin.team.create') }}">Add the first one.</a>
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="60">Photo</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Department</th>
                        <th>Email</th>
                        <th>Joined</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                    <tr>
                        <td>
                            @if($member->profile_image)
                                <img src="{{ asset('storage/' . $member->profile_image) }}" alt="" class="rounded-circle" style="width:40px;height:40px;object-fit:cover;">
                            @else
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                    <i class="fas fa-user text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-semibold small">{{ $member->first_name }} {{ $member->last_name }}</td>
                        <td class="small">{{ $member->position }}</td>
                        <td class="small text-muted">{{ $member->department ?? '-' }}</td>
                        <td class="small">{{ $member->email }}</td>
                        <td class="small text-muted">{{ $member->joining_date ? \Carbon\Carbon::parse($member->joining_date)->format('M d, Y') : '-' }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.team.show', $member) }}" class="btn btn-sm btn-outline-info" title="View"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.team.edit', $member) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.team.destroy', $member) }}" onsubmit="return confirm('Delete this member?')">
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
        <div class="p-3">{{ $members->links() }}</div>
        @endif
    </div>
</div>
@endsection
