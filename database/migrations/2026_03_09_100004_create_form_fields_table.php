<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained('forms')->cascadeOnDelete();
            $table->string('label');
            $table->string('name');
            $table->enum('type', ['text', 'email', 'phone', 'textarea', 'select', 'checkbox', 'radio', 'date'])->default('text');
            $table->string('placeholder')->nullable();
            $table->boolean('required')->default(false);
            $table->json('options')->nullable(); // for select, radio, checkbox
            $table->json('validation_rules')->nullable();
            $table->integer('order')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_fields');
    }
};
