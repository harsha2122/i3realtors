<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $settings = [
            [
                'key'         => 'about_main_image',
                'value'       => null,
                'type'        => 'string',
                'group'       => 'about',
                'label'       => 'About Main Image (Homepage & About Page)',
                'description' => 'Primary image shown in the About section on homepage and about page.',
                'is_public'   => true,
            ],
            [
                'key'         => 'about_item_image_1',
                'value'       => null,
                'type'        => 'string',
                'group'       => 'about',
                'label'       => 'About Box 1 Image',
                'description' => 'Icon/image for the first about box (Strategic Market Understanding / Your Trusted Partners).',
                'is_public'   => true,
            ],
            [
                'key'         => 'about_item_image_2',
                'value'       => null,
                'type'        => 'string',
                'group'       => 'about',
                'label'       => 'About Box 2 Image',
                'description' => 'Image for the second about box (Investor Network / Strategic Market Expertise).',
                'is_public'   => true,
            ],
            [
                'key'         => 'breadcrumb_bg',
                'value'       => null,
                'type'        => 'string',
                'group'       => 'about',
                'label'       => 'Breadcrumb / Page Header Background Image',
                'description' => 'Background image for the page header/breadcrumb banner on the About page.',
                'is_public'   => true,
            ],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->insertOrIgnore($setting + ['created_at' => now(), 'updated_at' => now()]);
        }
    }

    public function down(): void
    {
        DB::table('settings')->whereIn('key', [
            'about_main_image',
            'about_item_image_1',
            'about_item_image_2',
            'breadcrumb_bg',
        ])->delete();
    }
};
