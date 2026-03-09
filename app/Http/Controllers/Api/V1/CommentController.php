<?php

namespace App\Http\Controllers\Api\V1;

use App\Domains\Blogs\Models\Post;
use App\Domains\Blogs\Repositories\CommentRepository;
use App\Domains\Blogs\Services\CommentService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(
        private CommentRepository $repository,
        private CommentService $service,
    ) {}

    public function index(Post $post): JsonResponse
    {
        $comments = $this->repository->approvedByPost($post->id);

        return response()->json($comments);
    }

    public function store(Request $request, Post $post): JsonResponse
    {
        $validated = $request->validate([
            'author_name' => 'required|string|max:255',
            'author_email' => 'required|email',
            'content' => 'required|string|min:3',
        ]);

        $validated['post_id'] = $post->id;

        $comment = $this->service->submitComment($validated);

        return response()->json([
            'message' => 'Comment submitted for moderation',
            'comment' => $comment,
        ], 201);
    }
}
