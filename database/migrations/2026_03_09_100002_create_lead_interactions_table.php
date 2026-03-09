<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lead_interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('leads')->cascadeOnDelete();
            $table->enum('type', ['note', 'email', 'call', 'meeting', 'status_change', 'assignment'])->default('note');
            $table->longText('content');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('created_at');

            $table->index('lead_id');
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lead_interactions');
    }
};
