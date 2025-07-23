<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('opds', function (Blueprint $table) {
            $table->string('kodeopd', 150)->primary();
            $table->longText('namaopd');
            $table->string('kodeass', 10);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('opds');
    }
};