<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'HR-Admin',
            'email' => 'hradmin@example.com',
            'password' => Hash::make('123123'),
            'level' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
    }
}
