<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            ProdusenSeeder::class,
            PoliklinikSeeder::class,
            RoleSeeder::class,
            KategoriObatSeeder::class,
            GolonganObatSeeder::class,
            UserSeeder::class,
            KaryawansSeeder::class,
            DokterSeeder::class,
        ]);
    }
}
