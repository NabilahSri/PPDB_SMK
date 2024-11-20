<?php

namespace Database\Seeders;

use App\Models\Pengelola;
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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Nurul Aini',
            'nisn' => '012345',
            'password' => bcrypt('12341234'),
            'level' => 'siswa'
        ]);

        User::create([
            'name' => 'Nurul Aini',
            'username' => 'isna',
            'password' => bcrypt('12341234'),
            'level' => 'admin'
        ]);

        // Pengelola::create([
        //     'nama' => 'Isna',
        //     'username' => 'isna',
        //     'password' => bcrypt('12341234'),
        // ]);
    }
}
