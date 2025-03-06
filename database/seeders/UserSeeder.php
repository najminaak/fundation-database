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
        DB::table('user_datas')->delete();
        DB::table('users')->delete();
        DB::table('users')->insert([
            [
                'account_id' => generate_account_id(),
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active',
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'account_id' => generate_account_id(),
                'email' => 'organizer@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'organizer',
                'status' => 'active',
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'account_id' => generate_account_id(),
                'email' => 'mitra@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'entrepreneur',
                'status' => 'active',
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
