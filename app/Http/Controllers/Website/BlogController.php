<?php

namespace App\Http\Controllers\Website;

use App\Domains\Blogs\Models\Post;
use App\Domains\Blogs\Repositories\PostRepository;
use App\Domains\Blogs\Services\PostService;
use App\Domains\Blogs\Models\Category;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function __construct(
        private PostRepository $repository,
        private PostService $service,
    ) {}

    public function index()
    {
        $posts = $this->repository->published(10);
        $categories = Category::where('is_active', true)->get();
        $recentPosts = Post::published()->latest('published_at')->limit(5)->get();

        return view('website.blog', compact('posts', 'categories', 'recentPosts'));
    }

    public function show(string $slug)
    {
        $post = $this->repository->bySlug($slug);
        $this->service->trackView($post);
        $relatedPosts = $this->service->getRelatedPosts($post);
        $recentPosts = Post::published()->where('id', '!=', $post->id)->latest('published_at')->limit(5)->get();
        $categories = Category::where('is_active', true)->withCount(['posts' => fn($q) => $q->published()])->get();

        return view('website.blog-details', compact('post', 'relatedPosts', 'recentPosts', 'categories'));
    }
}
