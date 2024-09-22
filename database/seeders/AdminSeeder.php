<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert default values into the admins table
        DB::table('admins')->insert([
            'username' => 'admin',
            'password' => '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918',
            'firstname' => 'admin',
            'lastname' => 'admin',
            'email' => 'admin@gmail.com',
            'image' => NULL,
            'ip' => NULL,
            'status' => 1,
            'admin_group_id' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
