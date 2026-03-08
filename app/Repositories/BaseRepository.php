<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all records with optional filters.
     */
    public function all(array $filters = [], array $with = []): Collection
    {
        return $this->model->newQuery()
            ->with($with)
            ->get();
    }

    /**
     * Get paginated records.
     */
    public function paginate(int $perPage = 15, array $filters = [], array $with = []): LengthAwarePaginator
    {
        return $this->model->newQuery()
            ->with($with)
            ->paginate($perPage);
    }

    /**
     * Find a record by ID.
     */
    public function find(int $id, array $with = []): ?Model
    {
        return $this->model->newQuery()
            ->with($with)
            ->find($id);
    }

    /**
     * Find a record by ID or throw 404.
     */
    public function findOrFail(int $id, array $with = []): Model
    {
        return $this->model->newQuery()
            ->with($with)
            ->findOrFail($id);
    }

    /**
     * Find records by a specific field.
     */
    public function findBy(string $field, mixed $value, array $with = []): ?Model
    {
        return $this->model->newQuery()
            ->with($with)
            ->where($field, $value)
            ->first();
    }

    /**
     * Find a record by slug.
     */
    public function findBySlug(string $slug, array $with = []): ?Model
    {
        return $this->findBy('slug', $slug, $with);
    }

    /**
     * Create a new record.
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Update a record by ID.
     */
    public function update(int $id, array $data): Model
    {
        $record = $this->findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    /**
     * Delete a record by ID.
     */
    public function delete(int $id): bool
    {
        $record = $this->findOrFail($id);
        return $record->delete();
    }

    /**
     * Count records.
     */
    public function count(): int
    {
        return $this->model->count();
    }

    /**
     * Check if a record exists.
     */
    public function exists(string $field, mixed $value): bool
    {
        return $this->model->where($field, $value)->exists();
    }
}
