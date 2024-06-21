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
        // nanti bakal main di semua controller bakal store/insert data tersebut ke db sbg dokumentasi dari user log nya
        Schema::create('user_logs', function (Blueprint $table) {
            $table->id();
            $table->string('session_idUser');
            $table->string('nama_aktifitas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_logs');
    }
};
