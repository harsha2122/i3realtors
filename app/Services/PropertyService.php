<?php

namespace App\Services;

use App\Models\Property;
use App\Models\PropertyImage;
use App\Repositories\PropertyRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyService
{
    public function __construct(private PropertyRepository $repo) {}

    public function adminList(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->repo->paginate($perPage, $filters, ['images', 'creator']);
    }

    public function publicList(array $filters = [], int $perPage = 9): LengthAwarePaginator
    {
        return $this->repo->publicListing($filters, $perPage);
    }

    public function find(int $id): Property
    {
        return $this->repo->findOrFail($id, ['images', 'creator']);
    }

    public function findBySlug(string $slug): ?Property
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

    public function create(array $data, ?UploadedFile $thumbnail = null, array $galleryFiles = []): Property
    {
        $data['created_by'] = Auth::id();
        $data['is_featured'] = isset($data['is_featured']);
        $data['is_active']   = isset($data['is_active']);

        if ($thumbnail) {
            $data['thumbnail'] = $thumbnail->store('properties/thumbnails', 'public');
        }

        $property = $this->repo->create($data);

        $this->storeGallery($property, $galleryFiles);

        return $property;
    }

    public function update(int $id, array $data, ?UploadedFile $thumbnail = null, array $galleryFiles = []): Property
    {
        $property = $this->repo->findOrFail($id);

        $data['is_featured'] = isset($data['is_featured']);
        $data['is_active']   = isset($data['is_active']);

        if ($thumbnail) {
            if ($property->thumbnail) {
                Storage::disk('public')->delete($property->thumbnail);
            }
            $data['thumbnail'] = $thumbnail->store('properties/thumbnails', 'public');
        }

        $property->update($data);
        $this->storeGallery($property, $galleryFiles);

        return $property->fresh(['images']);
    }

    public function delete(int $id): void
    {
        $property = $this->repo->findOrFail($id, ['images']);

        // Delete all images
        if ($property->thumbnail) {
            Storage::disk('public')->delete($property->thumbnail);
        }
        foreach ($property->images as $img) {
            Storage::disk('public')->delete($img->image);
        }

        $property->delete();
    }

    public function deleteImage(int $imageId): void
    {
        $image = PropertyImage::findOrFail($imageId);
        Storage::disk('public')->delete($image->image);
        $image->delete();
    }

    private function storeGallery(Property $property, array $files): void
    {
        foreach ($files as $file) {
            if ($file instanceof UploadedFile && $file->isValid()) {
                $path = $file->store('properties/gallery', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image'       => $path,
                    'sort_order'  => $property->images()->count(),
                ]);
            }
        }
    }
}
