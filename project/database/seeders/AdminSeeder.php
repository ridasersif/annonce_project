<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder

{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'rida sersif',
            'email' => 'ridasersif1@gmail.com',
            'password' => Hash::make('Rida123sersif@'),
            'role_id' => 1,
            ]);
    }
}
