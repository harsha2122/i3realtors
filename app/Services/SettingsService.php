<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SettingsService
{
    /**
     * Get all settings for a group, keyed by setting key.
     */
    public function getGroup(string $group): \Illuminate\Database\Eloquent\Collection
    {
        return Setting::where('group', $group)->orderBy('id')->get()->keyBy('key');
    }

    /**
     * Update settings for a group from request data.
     * Handles file uploads, boolean toggles, and plain values.
     */
    public function updateGroup(string $group, array $data, array $files = []): void
    {
        $settings = Setting::where('group', $group)->get();

        foreach ($settings as $setting) {
            // Handle file upload fields (images and videos)
            if (isset($files[$setting->key]) && $files[$setting->key] instanceof UploadedFile) {
                $this->handleFileUpload($setting, $files[$setting->key], $group);
                continue;
            }

            // Handle boolean/checkbox fields (unchecked checkboxes are absent from request)
            if ($setting->type === 'boolean') {
                $setting->update(['value' => isset($data[$setting->key]) ? '1' : '0']);
                continue;
            }

            // Handle regular fields
            if (array_key_exists($setting->key, $data)) {
                $setting->update(['value' => $data[$setting->key]]);
            }
        }

        Setting::clearCache();
    }

    /**
     * Handle file upload: store new file, delete old file.
     */
    private function handleFileUpload(Setting $setting, UploadedFile $file, string $group): void
    {
        // Delete old file if exists
        if ($setting->value && Storage::disk('public')->exists($setting->value)) {
            Storage::disk('public')->delete($setting->value);
        }

        $mimeType = $file->getMimeType();
        $isVideo  = str_starts_with($mimeType, 'video/');
        $folder   = $isVideo ? "settings/{$group}/videos" : "settings/{$group}";
        $path     = $file->store($folder, 'public');
        $setting->update(['value' => $path]);
    }

    /**
     * Delete a media file associated with a setting key.
     */
    public function deleteMedia(string $key): bool
    {
        $setting = Setting::where('key', $key)->first();

        if (!$setting || !$setting->value) {
            return false;
        }

        if (Storage::disk('public')->exists($setting->value)) {
            Storage::disk('public')->delete($setting->value);
        }

        $setting->update(['value' => null]);
        Setting::clearCache();

        return true;
    }

    /**
     * Set a single setting value.
     */
    public function set(string $key, mixed $value, string $group = 'general'): void
    {
        Setting::set($key, $value, $group);
    }

    /**
     * Get a single setting value.
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return Setting::get($key, $default);
    }
}
