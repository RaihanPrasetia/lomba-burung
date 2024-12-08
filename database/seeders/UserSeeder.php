<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat contoh data untuk tabel users
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'), // Password terenkripsi
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jakarta',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juri 1',
                'email' => 'juri1@example.com',
                'password' => Hash::make('password'),
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Bandung',
                'role' => 'juri',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juri 2',
                'email' => 'juri2@example.com',
                'password' => Hash::make('password'),
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Surabaya',
                'role' => 'juri',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User A',
                'email' => 'usera@example.com',
                'password' => Hash::make('password'),
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Yogyakarta',
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User B',
                'email' => 'userb@example.com',
                'password' => Hash::make('password'),
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Medan',
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
