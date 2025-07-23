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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip', 18)->unique(); // Add this line
            $table->string('whatsapp', 15)->nullable(); // Add this line
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('opd_id', 150);
            $table->foreign('opd_id')
                  ->references('kodeopd')
                  ->on('opds')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->boolean('is_approved')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};