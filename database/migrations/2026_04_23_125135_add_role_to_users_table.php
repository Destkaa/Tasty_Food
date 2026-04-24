<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Pastikan tabel 'users' ada sebelum menambah kolom
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                // Cek dulu apakah kolom 'role' sudah ada atau belum supaya tidak duplikat
                if (!Schema::hasColumn('users', 'role')) {
                    $table->string('role')->default('user')->after('email');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ini WAJIB diisi agar saat rollback kolom 'role' dihapus
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
};