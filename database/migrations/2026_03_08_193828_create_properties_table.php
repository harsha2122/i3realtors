<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            // Pricing
            $table->decimal('price', 15, 2)->nullable();
            $table->string('price_label', 100)->nullable();
            $table->enum('price_type', ['sale', 'rent', 'lease'])->default('sale');

            // Classification
            $table->enum('type', ['residential', 'commercial', 'industrial', 'infrastructure', 'plot'])->default('residential');
            $table->enum('status', ['available', 'sold', 'under_construction', 'coming_soon'])->default('available');

            // Details
            $table->decimal('area', 10, 2)->nullable();
            $table->string('area_unit', 20)->default('sqft');
            $table->unsignedTinyInteger('bedrooms')->nullable();
            $table->unsignedTinyInteger('bathrooms')->nullable();
            $table->unsignedTinyInteger('floors')->nullable();

            // Location
            $table->string('location')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->text('google_maps_url')->nullable();

            // Media
            $table->string('thumbnail')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            // Flags
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['is_active', 'is_featured']);
            $table->index(['type', 'status']);
            $table->index('city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
