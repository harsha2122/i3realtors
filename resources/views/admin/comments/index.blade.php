@extends('admin.layouts.app')

@section('title', 'Comments')
@section('page-title', 'Comment Moderation')
@section('breadcrumb')
    <li class="breadcrumb-item active">Comments</li>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0"><i class="fas fa-comments me-2" style="color:var(--primary)"></i>Pending Comments</h6>
        <a href="{{ route('admin.comments.spam') }}" class="btn btn-outline-warning btn-sm">
            <i class="fas fa-shield-alt me-1"></i>Spam
        </a>
    </div>

    <div class="card-body p-0">
        @if($comments->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-comments fa-3x mb-3 d-block opacity-25"></i>
                No pending comments.
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Author</th>
                        <th>Comment</th>
                        <th>Post</th>
                        <th>Date</th>
                        <th width="200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                    <tr>
                        <td>
                            <div class="fw-semibold small">{{ $comment->author_name ?? 'Anonymous' }}</div>
                            <div class="text-muted small">{{ $comment->author_email ?? '' }}</div>
                        </td>
                        <td class="small">{{ Str::limit($comment->content, 100) }}</td>
                        <td class="small">{{ $comment->post->title ?? '-' }}</td>
                        <td class="small text-muted">{{ $comment->created_at->diffForHumans() }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <form method="POST" action="{{ route('admin.comments.approve', $comment) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success" title="Approve"><i class="fas fa-check"></i></button>
                                </form>
                                <form method="POST" action="{{ route('admin.comments.reject', $comment) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-warning" title="Reject"><i class="fas fa-times"></i></button>
                                </form>
                                <form method="POST" action="{{ route('admin.comments.spam', $comment) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-secondary" title="Mark Spam"><i class="fas fa-shield-alt"></i></button>
                                </form>
                                <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" onsubmit="return confirm('Delete?')">
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
        @endif
    </div>
</div>
@endsection
