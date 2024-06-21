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
        Schema::create('detail_customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_customer')->constrained('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_title')->constrained('titles')->onDelete('cascade')->onUpdate('cascade');
            $table->string("nama");
            $table->foreignId('id_occupation')->constrained('occupations')->onDelete('cascade')->onUpdate('cascade');
            $table->string("email");
            $table->string("phone");
            $table->string("doc_signature");
            $table->text("image");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_customers');
    }
};
