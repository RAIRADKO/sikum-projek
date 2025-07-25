<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nomorsk', function (Blueprint $table) {
            // Menambahkan kolom status setelah kolom 'kodesk'
            // Default value adalah 'proses'
            $table->string('status', 20)->default('proses')->after('kodesk');
        });
    }

    public function down(): void
    {
        Schema::table('nomorsk', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};