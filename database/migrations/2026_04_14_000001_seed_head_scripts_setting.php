<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $settings = [
            ['key' => 'head_scripts', 'value' => '', 'group' => 'seo', 'type' => 'textarea', 'label' => 'Custom Head Scripts', 'is_public' => true],
        ];

        foreach ($settings as $s) {
            DB::table('settings')->insertOrIgnore($s);
        }
    }

    public function down(): void
    {
        DB::table('settings')->whereIn('key', ['head_scripts'])->delete();
    }
};
