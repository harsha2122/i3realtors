<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('settings')
            ->whereIn('key', ['meta_title', 'meta_description', 'meta_keywords', 'google_analytics', 'meta_pixel'])
            ->update(['is_public' => true]);
    }

    public function down(): void
    {
        DB::table('settings')
            ->whereIn('key', ['meta_title', 'meta_description', 'meta_keywords', 'google_analytics', 'meta_pixel'])
            ->update(['is_public' => false]);
    }
};
