<?php

namespace App\Domains\Blogs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'featured_image',
        'excerpt',
        'content',
        'category_id',
        'author_id',
        'status',
        'published_at',
        'view_count',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'author_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function views(): HasMany
    {
        return $this->hasMany(PostView::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')->whereNotNull('published_at');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->published();
    }

    public function getReadingTimeAttribute(): int
    {
        $wordCount = str_word_count(strip_tags($this->content));
        return ceil($wordCount / 200);
    }

    public function incrementViewCount(): void
    {
        $this->increment('view_count');
    }

    public function getRelatedPosts(int $limit = 4)
    {
        return static::published()
            ->where('id', '!=', $this->id)
            ->whereHas('tags', function ($query) {
                $query->whereIn('id', $this->tags->pluck('id'));
            })
            ->limit($limit)
            ->get();
    }
}
