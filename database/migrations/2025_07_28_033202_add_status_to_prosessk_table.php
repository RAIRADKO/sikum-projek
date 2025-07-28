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
        Schema::table('prosessk', function (Blueprint $table) {
            // Menambahkan kolom status setelah 'nosk' dengan nilai default 'Proses'
            $table->string('status', 20)->default('Proses')->after('nosk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prosessk', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};