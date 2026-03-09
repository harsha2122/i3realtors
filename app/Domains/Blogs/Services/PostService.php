<?php

namespace App\Domains\Blogs\Services;

use App\Domains\Blogs\Models\Post;
use App\Domains\Blogs\Models\PostView;
use App\Domains\Blogs\Repositories\PostRepository;
use Illuminate\Support\Str;

class PostService
{
    public function __construct(
        private PostRepository $repository,
    ) {}

    public function createPost(array $data): Post
    {
        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        $data['author_id'] = auth()->id();
        $data['status'] = 'draft';

        $post = $this->repository->create($data);

        if (isset($data['tags'])) {
            $this->attachTags($post, $data['tags']);
        }

        return $post;
    }

    public function updatePost(Post $post, array $data): Post
    {
        if (isset($data['title']) && !isset($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $this->repository->update($post, $data);

        if (isset($data['tags'])) {
            $this->attachTags($post, $data['tags']);
        }

        return $post->fresh();
    }

    public function publishPost(Post $post): Post
    {
        $this->repository->publish($post);
        return $post->fresh();
    }

    public function archivePost(Post $post): Post
    {
        $this->repository->archive($post);
        return $post->fresh();
    }

    public function deletePost(Post $post): bool
    {
        return $this->repository->delete($post);
    }

    public function attachTags(Post $post, array $tagNames): void
    {
        $tags = collect($tagNames)
            ->map(function ($name) {
                return \App\Domains\Blogs\Models\Tag::firstOrCreate(
                    ['slug' => Str::slug($name)],
                    ['name' => $name]
                );
            })
            ->pluck('id')
            ->toArray();

        $this->repository->syncTags($post, $tags);
    }

    public function trackView(Post $post, ?string $ip = null, ?string $userAgent = null): void
    {
        PostView::create([
            'post_id' => $post->id,
            'ip_address' => $ip ?? request()->ip(),
            'user_agent' => $userAgent ?? request()->userAgent(),
            'referer' => request()->header('referer'),
            'created_at' => now(),
        ]);

        $post->incrementViewCount();
    }

    public function getReadingTime(Post $post): int
    {
        return $post->getReadingTimeAttribute();
    }

    public function getRelatedPosts(Post $post, int $limit = 4)
    {
        return $this->repository->getRelated($post, $limit);
    }
}
