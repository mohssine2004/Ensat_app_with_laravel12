<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'nom' => 'Admin',
            'prenom' => 'System',
            'tele' => '0600000000',
            'email' => 'itsmemrx2@gmail.com', // Updated to your email
            'password' => null, // No password needed for Google Auth
            'role' => 'admin',
            'firebase_uid' => 'TEMP_ADMIN_UID', // Placeholder
        ]);
    }
}
