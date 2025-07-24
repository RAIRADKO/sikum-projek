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
        Schema::create('nomorpb', function (Blueprint $table) {
            $table->integer('nopb')->primary();
            $table->date('tglpb')->nullable();
            $table->longText('judulpb')->nullable();
            $table->mediumText('kodeopd')->nullable();
            $table->text('seri')->nullable();
            $table->integer('noseri')->nullable();
            $table->date('tglpengundangan')->nullable();
            $table->date('tglturunpb')->nullable();
            $table->date('tglambilpb')->nullable();
            $table->longText('namapengambilpb')->nullable();
            $table->longText('namabon')->nullable();
            $table->date('tglbon')->nullable();
            $table->longText('alasanbonpb')->nullable();
            $table->longText('ket')->nullable();
            $table->string('kodepb', 10)->nullable();
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
        Schema::dropIfExists('nomorpb');
    }
};