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
        Schema::create('proseslain', function (Blueprint $table) {
            $table->string('kodelain', 10)->primary();
            $table->date('tglmasuk')->nullable();
            $table->longText('sedian')->nullable();
            $table->longText('judul')->nullable();
            $table->longText('kodeopd')->nullable();
            $table->longText('jmlttd')->nullable();
            $table->date('tglnaikkabag')->nullable();
            $table->date('tglnaikass')->nullable();
            $table->longText('kodeass')->nullable();
            $table->date('tglturun')->nullable();
            $table->longText('ket')->nullable();
            $table->string('nowa', 20)->nullable();
            $table->date('tglambil')->nullable();
            $table->longText('namaambil')->nullable();
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
        Schema::dropIfExists('proseslain');
    }
};