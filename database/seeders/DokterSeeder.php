<?php

namespace Database\Seeders;

use App\Models\Dokter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DokterSeeder extends Seeder
{

    public function run(): void
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $dokter = [
            [
                "karyawan_id" => 2,
                "poliklinik_id" => 1,
                "no_izin" => "22323232323",
                "created_at" => $date,
                "updated_at" => $date,
            ]
        ];
        Dokter::insert($dokter);
    }
}
