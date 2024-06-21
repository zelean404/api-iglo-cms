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
        Schema::create('detail__organization_structures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_os')->constrained('organization_structures')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_um')->constrained('user_manages')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_posisi')->constrained('positions')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_workgroup');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail__organization_structures');
    }
};
