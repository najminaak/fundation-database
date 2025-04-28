<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data yang ada sebelumnya
        DB::table('users')->delete(); // Menggunakan delete daripada truncate

        // Insert users data
        DB::table('users')->insert([
            [
                'id' => 1,
                'account_id' => Str::random(10),
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'account_id' => Str::random(10),
                'email' => 'organizer@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'organizer',
                'status' => 'active',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'account_id' => Str::random(10),
                'email' => 'mitra@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'entrepreneur',
                'status' => 'active',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'account_id' => Str::random(10),
                'email' => 'user4@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'entrepreneur',
                'status' => 'active',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'account_id' => Str::random(10),
                'email' => 'user5@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'organizer',
                'status' => 'active',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
