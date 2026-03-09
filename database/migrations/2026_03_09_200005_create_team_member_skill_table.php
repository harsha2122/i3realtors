<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_member_skill', function (Blueprint $table) {
            $table->foreignId('team_member_id')->constrained('team_members')->cascadeOnDelete();
            $table->foreignId('team_skill_id')->constrained('team_skills')->cascadeOnDelete();
            $table->enum('proficiency', ['beginner', 'intermediate', 'advanced', 'expert'])->default('intermediate');
            $table->primary(['team_member_id', 'team_skill_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_member_skill');
    }
};
