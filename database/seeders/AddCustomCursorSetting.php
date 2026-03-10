<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class AddCustomCursorSetting extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['key' => 'custom_cursor'],
            [
                'value' => null,
                'type' => 'string',
                'group' => 'branding',
                'label' => 'Custom Cursor',
                'description' => 'Upload a PNG image to replace the default cursor across the entire site.',
                'is_public' => false,
            ]
        );
    }
}
