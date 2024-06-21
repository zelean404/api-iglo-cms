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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code_name');
            $table->foreignId('id_industry_type')->constrained('industri_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_company_scale')->constrained('company_scales')->onDelete('cascade')->onUpdate('cascade');
            $table->string('email');
            $table->string('phone');
            $table->string('nib');
            $table->string('npwp');
            $table->string('website');
            $table->string('location');
            $table->string('establish');
            $table->string('join_iglo');
            $table->text('file_document');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
