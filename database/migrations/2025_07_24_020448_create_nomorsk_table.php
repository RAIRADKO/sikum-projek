<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomorsk', function (Blueprint $table) {
            $table->integer('nosk')->primary();
            $table->date('tglsk')->nullable();
            $table->longText('judulsk')->nullable();
            $table->mediumText('kodeopd')->nullable();
            $table->date('tglturunsk')->nullable();
            $table->date('tglambilsk')->nullable();
            $table->longText('namapengambilsk')->nullable();
            $table->longText('namabon')->nullable();
            $table->date('tglbon')->nullable();
            $table->longText('alasanbonsk')->nullable();
            $table->longText('ket')->nullable();
            $table->string('kodesk', 10)->nullable();
            // $table->timestamps(); // Opsional: tambahkan jika perlu kolom created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nomorsk');
    }
};