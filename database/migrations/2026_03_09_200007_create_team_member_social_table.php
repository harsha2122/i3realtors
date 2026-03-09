<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_member_social', function (Blueprint $table) {
            $table->foreignId('team_member_id')->constrained('team_members')->cascadeOnDelete();
            $table->foreignId('team_social_id')->constrained('team_socials')->cascadeOnDelete();
            $table->string('url');
            $table->primary(['team_member_id', 'team_social_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_member_social');
    }
};
