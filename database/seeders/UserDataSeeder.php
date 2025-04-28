<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan data untuk user dengan ID yang ada di tabel 'users'
        DB::table('user_datas')->insert([
            [
                'user_id' => 1, // ID user admin
                'full_name' => 'Admin Example',
                'username' => 'adminexample',
                'phone' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // ID user organizer
                'full_name' => 'Organizer Example',
                'username' => 'organizerexample',
                'phone' => '082345678901',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3, // ID user entrepreneur
                'full_name' => 'Mitra Example',
                'username' => 'mitraexample',
                'phone' => '083456789012',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4, // ID user entrepreneur
                'full_name' => 'User 4 Example',
                'username' => 'user4example',
                'phone' => '084567890123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5, // ID user organizer
                'full_name' => 'User 5 Example',
                'username' => 'user5example',
                'phone' => '085678901234',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
