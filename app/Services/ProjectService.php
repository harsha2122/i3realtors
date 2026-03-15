<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectImage;
use App\Repositories\ProjectRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectService
{
    public function __construct(private ProjectRepository $repo) {}

    public function adminList(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->repo->paginate($perPage, $filters, ['images', 'creator']);
    }

    public function publicList(array $filters = [], int $perPage = 9): LengthAwarePaginator
    {
        return $this->repo->publicListing($filters, $perPage);
    }

    public function find(int $id): Project
    {
        return $this->repo->findOrFail($id, ['images', 'creator']);
    }

    public function findBySlug(string $slug): ?Project
    {
        return $this->repo->findBySlug($slug, ['images']);
    }

    public function featured(int $limit = 4)
    {
        return $this->repo->featured($limit);
    }

    public function cities()
    {
        return $this->repo->cities();
    }

    public function create(array $data, ?UploadedFile $thumbnail = null, array $galleryFiles = []): Project
    {
        $data['created_by'] = Auth::id();
        $data['is_featured'] = isset($data['is_featured']);
        $data['is_active']   = isset($data['is_active']);

        if ($thumbnail) {
            $data['thumbnail'] = $thumbnail->store('projects/thumbnails', 'public');
        }

        $project = $this->repo->create($data);
        $this->storeGallery($project, $galleryFiles);

        return $project;
    }

    public function update(int $id, array $data, ?UploadedFile $thumbnail = null, array $galleryFiles = []): Project
    {
        $project = $this->repo->findOrFail($id);

        $data['is_featured'] = isset($data['is_featured']);
        $data['is_active']   = isset($data['is_active']);

        if ($thumbnail) {
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }
            $data['thumbnail'] = $thumbnail->store('projects/thumbnails', 'public');
        }

        $project->update($data);
        $this->storeGallery($project, $galleryFiles);

        return $project->fresh(['images']);
    }

    public function delete(int $id): void
    {
        $project = $this->repo->findOrFail($id, ['images']);

        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }
        foreach ($project->images as $img) {
            Storage::disk('public')->delete($img->image);
        }

        $project->delete();
    }

    public function deleteImage(int $imageId): void
    {
        $image = ProjectImage::findOrFail($imageId);
        Storage::disk('public')->delete($image->image);
        $image->delete();
    }

    private function storeGallery(Project $project, array $files): void
    {
        foreach ($files as $file) {
            if ($file instanceof UploadedFile && $file->isValid()) {
                $path = $file->store('projects/gallery', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image'      => $path,
                    'sort_order' => $project->images()->count(),
                ]);
            }
        }
    }
}
