<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Buat Admin User
        User::create([
            'nama' => 'Admin',
            'email' => 'admin@poliklinik.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            'no_ktp' => '1234567890123456',
            'no_hp' => '08123456789',
            'no_rm' => 'ADMIN001',
            'alamat' => 'Jl. Admin No. 1',
            'role' => 'admin',
            'id_poli' => null,
        ]);

        // Buat Test User
        User::factory()->create([
            'nama' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
