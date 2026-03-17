<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql' || $driver === 'mariadb') {
            DB::statement("ALTER TABLE projects MODIFY COLUMN status ENUM('upcoming','ongoing','completed') NOT NULL DEFAULT 'ongoing'");
        }
        // SQLite stores enums as TEXT and does not enforce check constraints
        // created by Laravel's enum() — no schema change needed; 'upcoming' is accepted as-is.
    }

    public function down(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql' || $driver === 'mariadb') {
            DB::statement("UPDATE projects SET status = 'ongoing' WHERE status = 'upcoming'");
            DB::statement("ALTER TABLE projects MODIFY COLUMN status ENUM('ongoing','completed') NOT NULL DEFAULT 'ongoing'");
        }
    }
};
