<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat atau Memperbarui Akun Admin
        User::updateOrCreate(
            ['email' => 'admin@tasty.com'], // Cek berdasarkan email ini
            [
                'name'     => 'Admin Tasty',
                'password' => Hash::make('password123'),
                'role'     => 'admin',
            ]
        );

        // Membuat atau Memperbarui Akun User Biasa
        User::updateOrCreate(
            ['email' => 'user@tasty.com'], // Cek berdasarkan email ini
            [
                'name'     => 'User Biasa',
                'password' => Hash::make('password123'),
                'role'     => 'user',
            ]
        );
    }
}