<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ID 1
        User::create([
            'name' => 'Super User',
            'email' => 'SuperUsuario@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('Admin');
        User::create([
            'name' => 'Super User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
        ])->assignRole('Admin');
    }
}
