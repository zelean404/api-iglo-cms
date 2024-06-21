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
        Schema::create('user_manages', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('id_karyawan');
            $table->string('email');
            $table->string('telepon');
            $table->foreignId('id_role')->constrained('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->string('password');
            $table->string('status');
            $table->text('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_manages');
    }
};
