<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $settings = [
            // About page – Who We Are section
            ['key' => 'about_who_main_image',  'value' => null, 'group' => 'about', 'label' => 'About Page – Who We Are Main Image',  'type' => 'text'],
            ['key' => 'about_who_box1_image',  'value' => null, 'group' => 'about', 'label' => 'About Page – Who We Are Box 1 Image',  'type' => 'text'],
            ['key' => 'about_who_box2_image',  'value' => null, 'group' => 'about', 'label' => 'About Page – Who We Are Box 2 Image',  'type' => 'text'],
            // About page – Our Approach section
            ['key' => 'about_approach_image_1','value' => null, 'group' => 'about', 'label' => 'About Page – Our Approach Image 1',    'type' => 'text'],
            ['key' => 'about_approach_image_2','value' => null, 'group' => 'about', 'label' => 'About Page – Our Approach Image 2',    'type' => 'text'],
        ];

        foreach ($settings as $s) {
            DB::table('settings')->updateOrInsert(
                ['key' => $s['key']],
                array_merge($s, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }

    public function down(): void
    {
        DB::table('settings')->whereIn('key', [
            'about_who_main_image', 'about_who_box1_image', 'about_who_box2_image',
            'about_approach_image_1', 'about_approach_image_2',
        ])->delete();
    }
};
