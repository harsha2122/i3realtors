<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('career_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_job_id')->nullable()->constrained('career_jobs')->nullOnDelete();
            $table->string('job_title'); // snapshot of job title at time of application
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->integer('experience_years')->default(0);
            $table->text('cover_letter')->nullable();
            $table->string('resume_path')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_applications');
    }
};
