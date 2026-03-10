<?php

namespace App\Domains\Blogs\Repositories;

use App\Domains\Blogs\Models\Post;
use Illuminate\Pagination\Paginator;

class PostRepository
{
    public function all()
    {
        return Post::with('author', 'category', 'tags')->latest()->get();
    }

    public function published(int $perPage = 10)
    {
        return Post::published()
            ->with('author', 'category', 'tags')
            ->latest('published_at')
            ->paginate($perPage);
    }

    public function featured(int $limit = 5)
    {
        return Post::featured()
            ->with('author', 'category')
            ->limit($limit)
            ->get();
    }

    public function byCategory($categoryId, int $perPage = 10)
    {
        return Post::published()
            ->where('category_id', $categoryId)
            ->with('author', 'category', 'tags')
            ->latest('published_at')
            ->paginate($perPage);
    }

    public function byTag($tagId, int $perPage = 10)
    {
        return Post::published()
            ->whereHas('tags', fn($q) => $q->where('tags.id', $tagId))
            ->with('author', 'category', 'tags')
            ->latest('published_at')
            ->paginate($perPage);
    }

    public function bySlug(string $slug)
    {
        return Post::where('slug', $slug)
            ->with([
                'author',
                'category',
                'tags',
                'comments' => function($q) { return $q->approved(); }
            ])
            ->firstOrFail();
    }

    public function getRelated(Post $post, int $limit = 4)
    {
        return Post::published()
            ->where('id', '!=', $post->id)
            ->whereHas('tags', fn($q) => $q->whereIn('id', $post->tags->pluck('id')))
            ->with('author', 'category')
            ->limit($limit)
            ->get();
    }

    public function search(string $query, int $perPage = 10)
    {
        return Post::published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%")
                    ->orWhere('excerpt', 'like', "%{$query}%");
            })
            ->with('author', 'category', 'tags')
            ->latest('published_at')
            ->paginate($perPage);
    }

    public function create(array $data): Post
    {
        return Post::create($data);
    }

    public function update(Post $post, array $data): bool
    {
        return $post->update($data);
    }

    public function delete(Post $post): bool
    {
        return $post->delete();
    }

    public function syncTags(Post $post, array $tagIds): void
    {
        $post->tags()->sync($tagIds);
    }

    public function archive(Post $post): bool
    {
        return $post->update(['status' => 'archived']);
    }

    public function publish(Post $post): bool
    {
        return $post->update([
            'status' => 'published',
            'published_at' => now(),
        ]);
    }
}
