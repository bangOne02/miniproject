<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class RoleSeeder extends Seeder
{

    public function run(): void
    {
        $result = [];
        $temp1 = ["audit", "admin", "pendaftaran","dokter","apotik","user"];
        $date = Carbon::now()->format('Y-m-d H:i:s');
        for ($i = 0; $i < count($temp1); $i++) {
            $temp2 = ['name' => $temp1[$i],'created_at' => $date,'updated_at' => $date];
            array_push($result, $temp2);
        }
        Role::insert($result);
    }
}
