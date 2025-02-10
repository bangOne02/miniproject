<?php

use App\Models\Produsen;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('obats', function (Blueprint $table) {
            $table->foreignId('produsen_id')->constrained('produsens')->onUpdate('cascade')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        //
    }
};
