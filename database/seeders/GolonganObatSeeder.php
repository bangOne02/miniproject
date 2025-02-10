<?php

namespace Database\Seeders;

use App\Models\Golongan_obat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class GolonganObatSeeder extends Seeder
{

    public function run(): void
    {
        $result = [];
        $temp1 = ["obat bebas", "obat bebas terbatas", "obat keras"];
        $date = Carbon::now()->format('Y-m-d H:i:s');
        for ($i = 0; $i < count($temp1); $i++) {
            $temp2 = ['name' => $temp1[$i],'created_at' => $date,'updated_at' => $date];
            array_push($result, $temp2);
        }
        Golongan_obat::insert($result);
    }
}
