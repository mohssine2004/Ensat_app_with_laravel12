<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@etu.ac.ma'],
            [
                'nom' => 'Admin',
                'prenom' => 'System',
                'tele' => '0000000000',
                'password' => 'admin', // Will be hashed by mutator if exists, or should be Hash::make('admin')
                'role' => 'admin',
            ]
        );
    }
}
