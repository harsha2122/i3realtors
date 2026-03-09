<?php

namespace App\Domains\Blogs\Repositories;

use App\Domains\Blogs\Models\Comment;

class CommentRepository
{
    public function allByPost($postId, int $perPage = 10)
    {
        return Comment::where('post_id', $postId)
            ->latest()
            ->paginate($perPage);
    }

    public function approvedByPost($postId)
    {
        return Comment::where('post_id', $postId)
            ->approved()
            ->latest()
            ->get();
    }

    public function pending(int $perPage = 15)
    {
        return Comment::pending()
            ->with('post')
            ->latest()
            ->paginate($perPage);
    }

    public function spam(int $perPage = 15)
    {
        return Comment::where('is_spam', true)
            ->with('post')
            ->latest()
            ->paginate($perPage);
    }

    public function create(array $data): Comment
    {
        return Comment::create($data);
    }

    public function approve(Comment $comment): bool
    {
        return $comment->update(['status' => 'approved']);
    }

    public function reject(Comment $comment): bool
    {
        return $comment->update(['status' => 'rejected']);
    }

    public function markAsSpam(Comment $comment): bool
    {
        return $comment->update(['is_spam' => true]);
    }

    public function delete(Comment $comment): bool
    {
        return $comment->delete();
    }
}
