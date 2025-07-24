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
        Schema::create('prosespb', function (Blueprint $table) {
            $table->string('kodepb', 10)->primary();
            $table->date('tglmasukpb')->nullable();
            $table->longText('judulpb')->nullable();
            $table->mediumText('kodeopd')->nullable();
            $table->string('jmlttdpb', 1000)->nullable();
            $table->date('tglnaikkabag')->nullable();
            $table->date('tglnaikass')->nullable();
            $table->string('kodeass', 100)->nullable();
            $table->date('tglturunpb')->nullable();
            $table->mediumText('ketprosespb')->nullable();
            $table->string('nowa', 20)->nullable();
            $table->string('nopb', 100)->nullable();
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
        Schema::dropIfExists('prosespb');
    }
};