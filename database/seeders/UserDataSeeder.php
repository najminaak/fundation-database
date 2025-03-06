<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Import DB class
use Faker\Factory as Faker;

class UserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(array $userids=[]): void
    {
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            DB::table('user_datas')->insert([
                'user_id' => $user->id,
                'full_name' => fake()->name(),
                'username' => fake()->userName(),
                'phone' => fake()->phoneNumber(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
