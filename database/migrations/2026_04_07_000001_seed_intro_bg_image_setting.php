<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('settings')->updateOrInsert(
            ['key' => 'intro_bg_image'],
            [
                'value'      => null,
                'group'      => 'general',
                'label'      => 'Intro Section Background Image (Building Strategic Real Estate)',
                'type'       => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    public function down(): void
    {
        DB::table('settings')->where('key', 'intro_bg_image')->delete();
    }
};
