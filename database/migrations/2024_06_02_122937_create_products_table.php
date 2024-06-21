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
        Schema::create('products', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('nama');
            $table->string('versi');
            $table->foreignId('id_tipe')->constrained('types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_company')->constrained('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->string('deskripsi');
            $table->foreignId('id_um')->constrained('user_manages')->onDelete('cascade')->onUpdate('cascade');
            $table->text('image')->nullable();
            // $table->text('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
