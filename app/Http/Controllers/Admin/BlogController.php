<?php

namespace App\Http\Controllers\Admin;

use App\Domains\Blogs\Models\Category;
use App\Domains\Blogs\Models\Post;
use App\Domains\Blogs\Repositories\PostRepository;
use App\Domains\Blogs\Services\PostService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(
        private PostRepository $repository,
        private PostService $service,
    ) {}

    public function index()
    {
        $posts = Post::with('author', 'category')
            ->latest()
            ->paginate(15);

        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:posts',
            'featured_image' => 'nullable|image|max:2048',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'seo_title' => 'nullable|string|max:60',
            'seo_description' => 'nullable|string|max:160',
            'seo_keywords' => 'nullable|string',
        ]);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('blog', 'public');
            $validated['featured_image'] = $path;
        }

        $post = $this->service->createPost($validated);

        return redirect()->route('admin.blog.edit', $post)
            ->with('success', 'Post created successfully');
    }

    public function edit(Post $post)
    {
        $categories = Category::where('is_active', true)->get();
        $post->load('category', 'tags');

        return view('admin.blog.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:posts,slug,' . $post->id,
            'featured_image' => 'nullable|image|max:2048',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'seo_title' => 'nullable|string|max:60',
            'seo_description' => 'nullable|string|max:160',
            'seo_keywords' => 'nullable|string',
        ]);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('blog', 'public');
            $validated['featured_image'] = $path;
        }

        $this->service->updatePost($post, $validated);

        return redirect()->route('admin.blog.edit', $post)
            ->with('success', 'Post updated successfully');
    }

    public function publish(Post $post)
    {
        $this->service->publishPost($post);

        return redirect()->back()->with('success', 'Post published successfully');
    }

    public function archive(Post $post)
    {
        $this->service->archivePost($post);

        return redirect()->back()->with('success', 'Post archived successfully');
    }

    public function destroy(Post $post)
    {
        $this->service->deletePost($post);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Post deleted successfully');
    }

    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $ids = $request->input('ids', []);

        $posts = Post::whereIn('id', $ids)->get();

        foreach ($posts as $post) {
            match ($action) {
                'publish' => $this->service->publishPost($post),
                'unpublish' => $post->update(['status' => 'draft']),
                'archive' => $this->service->archivePost($post),
                'delete' => $this->service->deletePost($post),
            };
        }

        return redirect()->back()->with('success', "Action '$action' completed for " . count($posts) . " posts");
    }
}
