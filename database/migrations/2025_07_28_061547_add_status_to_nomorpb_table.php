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
        Schema::table('nomorpb', function (Blueprint $table) {
            // Menambahkan kolom 'status' setelah kolom 'noseri'
            // dengan nilai default 'proses'
            $table->string('status', 20)->default('proses')->after('noseri');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nomorpb', function (Blueprint $table) {
            // Menghapus kolom 'status' jika migrasi di-rollback
            $table->dropColumn('status');
        });
    }
};