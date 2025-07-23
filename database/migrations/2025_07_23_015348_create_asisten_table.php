<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('asisten', function (Blueprint $table) {
            $table->string('kodeass', 10)->primary();
            $table->text('namaass');
            $table->engine = 'InnoDB';
            $table->collation = 'utf8mb4_general_ci';
        });
    }

    public function down()
    {
        Schema::dropIfExists('asisten');
    }
};