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

        User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'username' => 'petugas',
            'email' => 'petugas@example.com',
            'role' => 'petugas',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'username' => 'peminjam',
            'email' => 'peminjam@example.com',
            'role' => 'peminjam',
            'password' => bcrypt('password'),
        ]);
    }
}
