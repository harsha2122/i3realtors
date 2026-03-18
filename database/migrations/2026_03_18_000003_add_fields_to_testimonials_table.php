<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('client_type')->nullable()->after('company');
            $table->string('project_name')->nullable()->after('client_type');
            $table->string('video_url')->nullable()->after('project_name');
        });
    }

    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['client_type', 'project_name', 'video_url']);
        });
    }
};
