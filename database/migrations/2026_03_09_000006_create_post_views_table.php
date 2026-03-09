<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('post_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts')->cascadeOnDelete();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('referer')->nullable();
            $table->timestamp('created_at');

            $table->index('post_id');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_views');
    }
};
