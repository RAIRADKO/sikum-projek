<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // up() method in your new migration file
    public function up(): void
    {
        Schema::table('prosessk', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    // down() method in your new migration file
    public function down(): void
    {
        Schema::table('prosessk', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};
