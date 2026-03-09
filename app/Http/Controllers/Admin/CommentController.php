<?php

namespace App\Http\Controllers\Admin;

use App\Domains\Blogs\Models\Comment;
use App\Domains\Blogs\Repositories\CommentRepository;
use App\Domains\Blogs\Services\CommentService;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function __construct(
        private CommentRepository $repository,
        private CommentService $service,
    ) {}

    public function index()
    {
        $comments = $this->repository->pending();

        return view('admin.comments.index', compact('comments'));
    }

    public function spam()
    {
        $comments = $this->repository->spam();

        return view('admin.comments.spam', compact('comments'));
    }

    public function approve(Comment $comment)
    {
        $this->service->approveComment($comment);

        return redirect()->back()->with('success', 'Comment approved');
    }

    public function reject(Comment $comment)
    {
        $this->service->rejectComment($comment);

        return redirect()->back()->with('success', 'Comment rejected');
    }

    public function markSpam(Comment $comment)
    {
        $this->repository->markAsSpam($comment);

        return redirect()->back()->with('success', 'Comment marked as spam');
    }

    public function destroy(Comment $comment)
    {
        $this->service->deleteComment($comment);

        return redirect()->back()->with('success', 'Comment deleted');
    }

    public function bulkAction()
    {
        $action = request('action');
        $ids = request('ids', []);

        $comments = Comment::whereIn('id', $ids)->get();

        foreach ($comments as $comment) {
            match ($action) {
                'approve' => $this->service->approveComment($comment),
                'reject' => $this->service->rejectComment($comment),
                'spam' => $this->repository->markAsSpam($comment),
                'delete' => $this->service->deleteComment($comment),
            };
        }

        return redirect()->back()->with('success', "Action completed for " . count($comments) . " comments");
    }
}
