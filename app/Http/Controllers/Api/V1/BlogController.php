<?php

namespace App\Http\Controllers\Api\V1;

use App\Domains\Blogs\Models\Post;
use App\Domains\Blogs\Repositories\PostRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    public function __construct(
        private PostRepository $repository,
    ) {}

    public function index(): JsonResponse
    {
        $posts = $this->repository->published(20);

        return response()->json($posts);
    }

    public function show(Post $post): JsonResponse
    {
        if ($post->status !== 'published') {
            return response()->json(['error' => 'Post not found'], 404);
        }

        return response()->json($post->load('author', 'category', 'tags'));
    }

    public function bySlug(string $slug): JsonResponse
    {
        $post = $this->repository->bySlug($slug);

        return response()->json($post->load('author', 'category', 'tags', 'comments'));
    }

    public function featured(int $limit = 5): JsonResponse
    {
        $posts = $this->repository->featured($limit);

        return response()->json($posts);
    }

    public function byCategory(int $categoryId): JsonResponse
    {
        $posts = $this->repository->byCategory($categoryId, 20);

        return response()->json($posts);
    }

    public function byTag(int $tagId): JsonResponse
    {
        $posts = $this->repository->byTag($tagId, 20);

        return response()->json($posts);
    }

    public function related(Post $post, int $limit = 4): JsonResponse
    {
        $related = $this->repository->getRelated($post, $limit);

        return response()->json($related);
    }

    public function search(string $query): JsonResponse
    {
        $posts = $this->repository->search($query, 20);

        return response()->json($posts);
    }
}
