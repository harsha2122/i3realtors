<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('career_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->default('general'); // sales, marketing, operations, presales, admin
            $table->string('employment_type')->default('Full-Time');
            $table->string('location')->default('Pune');
            $table->string('experience')->nullable(); // e.g. "1–3 Years"
            $table->text('description')->nullable();
            $table->json('responsibilities')->nullable(); // array of strings
            $table->json('requirements')->nullable();    // array of strings
            $table->string('status')->default('active');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_jobs');
    }
};
