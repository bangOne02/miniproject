<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $user = [
            array('role_id' => '2','name' => 'admin',  'email' => 'admin@gmail.com','password' => Hash::make('1234'),'created_at' => $date,'updated_at' => $date),
            array('role_id' => '3','name' => 'pendaftaran',  'email' => 'pendaftaran@gmail.com','password' => Hash::make('1234'),'created_at' => $date,'updated_at' => $date),
            array('role_id' => '4','name' => 'dokter',  'email' => 'dokter@gmail.com','password' => Hash::make('1234'),'created_at' => $date,'updated_at' => $date),
            array('role_id' => '5','name' => 'apotik',  'email' => 'apotik@gmail.com','password' => Hash::make('1234'),'created_at' => $date,'updated_at' => $date),
        ];
        User::insert($user);
    }
}
