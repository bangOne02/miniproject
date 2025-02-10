<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('dokters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')
                ->constrained('karyawans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('poliklinik_id')
                ->constrained('polikliniks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('no_izin');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};
