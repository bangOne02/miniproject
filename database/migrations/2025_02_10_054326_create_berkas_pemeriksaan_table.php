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
        Schema::create('berkas_pemeriksaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rekam_id');
            $table->string('file_path'); // Untuk menyimpan lokasi file yang diunggah
            $table->timestamps();

            $table->foreign('rekam_id')->references('id')->on('rekams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas_pemeriksaan');
    }
};
