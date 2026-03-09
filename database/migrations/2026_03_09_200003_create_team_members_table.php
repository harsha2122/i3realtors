<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('position');
            $table->string('department')->nullable();
            $table->longText('bio')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('profile_image')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('order')->default(0);
            $table->date('joining_date')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('department');
            $table->index('order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
