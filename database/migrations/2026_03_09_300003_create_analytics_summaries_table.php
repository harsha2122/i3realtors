<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analytics_summaries', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
            $table->integer('page_views')->default(0);
            $table->integer('unique_visitors')->default(0);
            $table->integer('conversion_count')->default(0);
            $table->decimal('conversion_rate', 5, 2)->default(0);
            $table->json('top_pages')->nullable();
            $table->json('traffic_sources')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analytics_summaries');
    }
};
