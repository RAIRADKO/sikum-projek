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
        Schema::table('proseslain', function (Blueprint $table) {
            // Menambahkan kolom status setelah kolom 'judul'
            $table->string('status')->after('judul')->nullable()->default('Diproses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proseslain', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};