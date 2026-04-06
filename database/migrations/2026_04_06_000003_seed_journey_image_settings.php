<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $settings = [
            ['key' => 'about_journey_image_1', 'value' => null, 'group' => 'about', 'label' => 'Our Journey – Image 1 (2021 Foundation)',         'type' => 'text'],
            ['key' => 'about_journey_image_2', 'value' => null, 'group' => 'about', 'label' => 'Our Journey – Image 2 (2023 Market Expansion)',    'type' => 'text'],
            ['key' => 'about_journey_image_3', 'value' => null, 'group' => 'about', 'label' => 'Our Journey – Image 3 (2023 Strategic Partners)',  'type' => 'text'],
            ['key' => 'about_journey_image_4', 'value' => null, 'group' => 'about', 'label' => 'Our Journey – Image 4 (Present Continued Growth)', 'type' => 'text'],
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
            'about_journey_image_1',
            'about_journey_image_2',
            'about_journey_image_3',
            'about_journey_image_4',
        ])->delete();
    }
};
