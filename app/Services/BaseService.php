<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseService
{
    protected BaseRepository $repository;

    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all(array $filters = [], array $with = []): Collection
    {
        return $this->repository->all($filters, $with);
    }

    public function paginate(int $perPage = 15, array $filters = [], array $with = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $filters, $with);
    }

    public function find(int $id, array $with = []): ?Model
    {
        return $this->repository->find($id, $with);
    }

    public function findOrFail(int $id, array $with = []): Model
    {
        return $this->repository->findOrFail($id, $with);
    }

    public function findBySlug(string $slug, array $with = []): ?Model
    {
        return $this->repository->findBySlug($slug, $with);
    }

    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): Model
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
