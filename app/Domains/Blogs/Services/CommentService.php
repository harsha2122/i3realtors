<?php

namespace App\Domains\Blogs\Services;

use App\Domains\Blogs\Models\Comment;
use App\Domains\Blogs\Repositories\CommentRepository;

class CommentService
{
    public function __construct(
        private CommentRepository $repository,
    ) {}

    public function submitComment(array $data): Comment
    {
        $data['status'] = 'pending';
        $data['is_spam'] = $this->detectSpam($data['content']);

        return $this->repository->create($data);
    }

    public function approveComment(Comment $comment): Comment
    {
        $this->repository->approve($comment);
        return $comment->fresh();
    }

    public function rejectComment(Comment $comment): Comment
    {
        $this->repository->reject($comment);
        return $comment->fresh();
    }

    public function deleteComment(Comment $comment): bool
    {
        return $this->repository->delete($comment);
    }

    private function detectSpam(string $content): bool
    {
        $spamKeywords = ['viagra', 'casino', 'lottery', 'click here'];

        foreach ($spamKeywords as $keyword) {
            if (stripos($content, $keyword) !== false) {
                return true;
            }
        }

        return false;
    }
}
