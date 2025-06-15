<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Cegah duplikat user dengan firstOrCreate
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'editor@example.com'],
            [
                'name' => 'Editor',
                'password' => bcrypt('password'),
                'role' => 'editor',
            ]
        );

        User::firstOrCreate(
            ['email' => 'wartawan@example.com'],
            [
                'name' => 'Wartawan',
                'password' => bcrypt('password'),
                'role' => 'wartawan',
            ]
        );

        // Panggil seeder lainnya
        $this->call([
            KategoriSeeder::class,
        ]);
    }
}
