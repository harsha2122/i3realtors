<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as BaseCollection;

class ProjectRepository extends BaseRepository
{
    public function __construct(Project $model)
    {
        parent::__construct($model);
    }

    public function paginate(int $perPage = 15, array $filters = [], array $with = []): LengthAwarePaginator
    {
        $query = $this->model->newQuery()->with($with);

        if (!empty($filters['search'])) {
            $query->search($filters['search']);
        }
        if (!empty($filters['type'])) {
            $query->ofType($filters['type']);
        }
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['city'])) {
            $query->inCity($filters['city']);
        }
        if (isset($filters['is_active']) && $filters['is_active'] !== '') {
            $query->where('is_active', $filters['is_active']);
        }

        return $query->orderBy('sort_order')->orderByDesc('created_at')->paginate($perPage);
    }

    public function publicListing(array $filters = [], int $perPage = 9): LengthAwarePaginator
    {
        $query = $this->model->active()->with('images');

        if (!empty($filters['search'])) {
            $query->search($filters['search']);
        }
        if (!empty($filters['type'])) {
            $query->ofType($filters['type']);
        }
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['city'])) {
            $query->inCity($filters['city']);
        }

        return $query->orderBy('sort_order')->orderByDesc('created_at')->paginate($perPage);
    }

    public function findBySlug(string $slug, array $with = []): ?Project
    {
        return $this->model->where('slug', $slug)->with($with ?: ['images'])->first();
    }

    public function featured(int $limit = 4): Collection
    {
        return $this->model->active()->featured()
            ->with('images')
            ->orderBy('sort_order')
            ->limit($limit)
            ->get();
    }

    public function cities(): BaseCollection
    {
        return $this->model->active()
            ->whereNotNull('city')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');
    }
}
