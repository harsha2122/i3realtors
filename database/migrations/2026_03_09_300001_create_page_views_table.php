<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->string('page');
            $table->string('referer')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('device_type')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->timestamp('created_at');

            $table->index('page');
            $table->index('created_at');
            $table->index('country');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_views');
    }
};
