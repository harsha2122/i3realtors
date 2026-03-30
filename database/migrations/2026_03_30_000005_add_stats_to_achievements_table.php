<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('achievements', function (Blueprint $table) {
            $table->string('units')->nullable()->after('image');
            $table->string('sales_value')->nullable()->after('units');
            $table->string('sold_percentage')->nullable()->after('sales_value');
            $table->string('time_period')->nullable()->after('sold_percentage');
            $table->string('location')->nullable()->after('time_period');
        });
    }

    public function down(): void
    {
        Schema::table('achievements', function (Blueprint $table) {
            $table->dropColumn(['units', 'sales_value', 'sold_percentage', 'time_period', 'location']);
        });
    }
};
