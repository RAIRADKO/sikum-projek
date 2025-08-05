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
        Schema::create('nota_pengajuan_sk', function (Blueprint $table) {
            $table->string('kodesk', 10)->primary();
            $table->string('ditujukan_kepada')->default('Bupati Purworejo');
            $table->string('melalui')->nullable();
            $table->text('lewat')->nullable();
            $table->string('dari')->nullable();
            $table->text('perihal')->nullable();
            $table->string('mohon_untuk')->nullable();
            $table->string('tanda_tangan')->nullable();
            $table->text('lain_lain')->nullable();
            $table->string('tempat_tanggal')->nullable();
            $table->string('jabatan_penandatangan')->nullable();
            $table->string('instansi_penandatangan')->nullable();
            $table->string('nama_penandatangan')->nullable();
            $table->string('pangkat_penandatangan')->nullable();
            $table->string('nip_penandatangan')->nullable();
            $table->timestamps();

            $table->foreign('kodesk')
                  ->references('kodesk')
                  ->on('prosessk')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_pengajuan_sk');
    }
};