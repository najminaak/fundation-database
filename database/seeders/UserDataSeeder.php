<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(array $userids=[]): void
    {
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            DB::table('userdata')->insert([
                'user_id' => $user->id,
                'fullname' => fake()->name(),
                'address' => fake()->address(),
                'phone' => fake()->phoneNumber(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
