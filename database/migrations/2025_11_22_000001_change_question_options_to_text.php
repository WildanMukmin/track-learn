<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mengubah type kolom opsi menjadi TEXT untuk menangani konten panjang
        DB::statement("ALTER TABLE questions ALTER COLUMN option_a TYPE text;");
        DB::statement("ALTER TABLE questions ALTER COLUMN option_b TYPE text;");
        DB::statement("ALTER TABLE questions ALTER COLUMN option_c TYPE text;");
        DB::statement("ALTER TABLE questions ALTER COLUMN option_d TYPE text;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke varchar(255)
        DB::statement("ALTER TABLE questions ALTER COLUMN option_a TYPE varchar(255);");
        DB::statement("ALTER TABLE questions ALTER COLUMN option_b TYPE varchar(255);");
        DB::statement("ALTER TABLE questions ALTER COLUMN option_c TYPE varchar(255);");
        DB::statement("ALTER TABLE questions ALTER COLUMN option_d TYPE varchar(255);");
    }
};
