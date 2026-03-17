<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description',
        'is_public',
    ];

    protected function casts(): array
    {
        return [
            'is_public' => 'boolean',
        ];
    }

    /**
     * Get a setting value by key, with optional default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = Cache::remember("setting_{$key}", 3600, function () use ($key) {
            return static::where('key', $key)->first();
        });

        if (! $setting) {
            return $default;
        }

        return static::castValue($setting->value, $setting->type);
    }

    /**
     * Set a setting value by key.
     */
    public static function set(string $key, mixed $value, string $group = 'general'): void
    {
        $storedValue = is_array($value) ? json_encode($value) : (string) $value;

        static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $storedValue,
                'group' => $group,
            ]
        );

        Cache::forget("setting_{$key}");
        Cache::forget('settings_all');
    }

    /**
     * Get all settings for a group.
     */
    public static function getGroup(string $group): array
    {
        return Cache::remember("settings_group_{$group}", 3600, function () use ($group) {
            return static::where('group', $group)
                ->get()
                ->mapWithKeys(function ($setting) {
                    return [$setting->key => static::castValue($setting->value, $setting->type)];
                })
                ->toArray();
        });
    }

    /**
     * Get all public settings.
     */
    public static function getAllPublic(): array
    {
        return Cache::remember('settings_all_public', 3600, function () {
            return static::where('is_public', true)
                ->get()
                ->mapWithKeys(function ($setting) {
                    return [$setting->key => static::castValue($setting->value, $setting->type)];
                })
                ->toArray();
        });
    }

    /**
     * Cast value to correct type.
     */
    protected static function castValue(mixed $value, string $type): mixed
    {
        return match ($type) {
            'json'    => json_decode($value, true),
            'boolean' => (bool) $value,
            'integer' => (int) $value,
            'float'   => (float) $value,
            default   => $value,
        };
    }

    /**
     * Clear all settings cache.
     */
    public static function clearCache(): void
    {
        $settings = static::all();
        $groups = [];
        foreach ($settings as $setting) {
            Cache::forget("setting_{$setting->key}");
            $groups[$setting->group] = true;
        }
        foreach (array_keys($groups) as $group) {
            Cache::forget("settings_group_{$group}");
        }
        Cache::forget('settings_all');
        Cache::forget('settings_all_public');
    }

    /**
     * Get the full URL for a file value.
     */
    public function getFileUrl(): ?string
    {
        if (!$this->value || !in_array($this->key, ['logo', 'logo_white', 'favicon', 'custom_cursor'])) {
            return null;
        }

        return '/uploads/' . $this->value;
    }
}
