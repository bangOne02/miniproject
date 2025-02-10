<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategoriobat_id')
                ->constrained('kategori_obats')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('golonganobat_id')
                ->constrained('golongan_obats')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('code');
            $table->string('name');
            $table->string('type');
            $table->integer('price')->default(0);
            $table->integer('stock')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obats');
    }
};
