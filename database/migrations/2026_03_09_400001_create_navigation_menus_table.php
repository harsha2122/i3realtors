<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('navigation_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // 'header-menu', 'footer-menu', etc.
            $table->string('slug')->unique(); // URL-friendly identifier
            $table->text('description')->nullable();
            $table->enum('position', ['header', 'footer', 'mobile', 'custom'])->default('header');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->index('is_active');
            $table->index('position');
        });

        Schema::create('navigation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained('navigation_menus')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('navigation_items')->onDelete('cascade');

            $table->string('label');
            $table->string('url')->nullable(); // Hardcoded URL
            $table->string('route_name')->nullable(); // Route name (e.g., 'about')
            $table->string('icon')->nullable(); // FontAwesome icon class (e.g., 'fa-home')
            $table->boolean('is_external')->default(false); // Is external link
            $table->enum('target_attribute', ['_self', '_blank', '_parent', '_top'])->default('_self');
            $table->boolean('is_visible')->default(true);
            $table->integer('order')->default(0);
            $table->json('attributes')->nullable(); // Custom data attributes
            $table->timestamps();

            $table->index(['menu_id', 'parent_id']);
            $table->index(['menu_id', 'order']);
            $table->index('is_visible');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('navigation_items');
        Schema::dropIfExists('navigation_menus');
    }
};
