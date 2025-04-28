<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('organizers')->delete();  // Hapus data lama sebelum seeding

        DB::table('organizers')->insert([
            [
                'user_id' => 2,  // user_id yang sudah ada di tabel users
                'organization_id' => 1,  // organization_id yang sudah ada di tabel organizations
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,  // user_id yang sudah ada di tabel users
                'organization_id' => 2,  // organization_id yang sudah ada di tabel organizations
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
