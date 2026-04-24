<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil RoleSeeder agar dijalankan saat db:seed
        $this->call([
            RoleSeeder::class,
        ]);

        // Opsional: Kamu tetap bisa menyisakan factory bawaan jika mau
        // User::factory(10)->create();
    }
}