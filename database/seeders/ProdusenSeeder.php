<?php

namespace Database\Seeders;

use App\Models\Produsen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ProdusenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produsen  = new Produsen();
        $produsen->name = "PT Kimia Farma";
        $produsen->is_active = 1;
        $produsen->save();
    }
}
