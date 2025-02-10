<?php

namespace Database\Seeders;

use App\Models\Kategori_obat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class KategoriObatSeeder extends Seeder
{

    public function run(): void
    {
        $kategori = [];
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $kategori_obat = ["antibiotik", "vitamin"];
        for ($i = 0; $i < count($kategori_obat); $i++) {
            $temp = [
                'name' => $kategori_obat[$i],
                'created_at' => $date,
                'updated_at' => $date
            ];
            array_push($kategori, $temp);
        }
        Kategori_obat::insert($kategori);
    }
}
