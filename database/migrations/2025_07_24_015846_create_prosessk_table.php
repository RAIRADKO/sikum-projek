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
        Schema::create('prosessk', function (Blueprint $table) {
            $table->string('kodesk', 10)->primary();
            $table->date('tglmasuksk')->nullable();
            $table->longText('judulsk')->nullable();
            $table->mediumText('kodeopd')->nullable();
            $table->string('kodeass', 100)->nullable();
            $table->string('jmlttdsk', 1000)->nullable();
            $table->date('tglnaikkabag')->nullable();
            $table->date('tglnaikass')->nullable();
            $table->date('tglturunsk')->nullable();
            $table->mediumText('ketprosessk')->nullable();
            $table->string('nowa', 20)->nullable();
            $table->integer('nosk')->nullable();
            // $table->timestamps(); // Opsional, jika Anda ingin kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prosessk');
    }
};