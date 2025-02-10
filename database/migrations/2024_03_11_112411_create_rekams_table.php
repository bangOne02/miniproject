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
        Schema::create('rekams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')
                ->constrained('pasiens')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('dokter_id')
                ->constrained('dokters')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('kode_rekam');
            $table->string('tekanan_darah',3);
            $table->string('rate',3);
            $table->string('suhu_badan',3);
            $table->string('berat_badan', 3);
            $table->string('tinggi_badan', 3);
            $table->string('keluhan_utama');
            $table->string('diagnosis')->nullable();
            $table->string('deskripsi_tindakan')->nullable();
            $table->string('created_by');
            $table->tinyInteger('status');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekams');
    }
};
