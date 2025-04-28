<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('organizations')->delete();  // Hapus data lama sebelum seeding

        DB::table('organizations')->insert([
            [
                'id' => 1,
                'name' => 'Organization One',
                'address' => 'Jl. Merdeka No. 1',
                'description' => 'Deskripsi organisasi pertama',
                'city' => 'City A',
                'province' => 'Province A',
                'photo_file' => 'photo_1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Organization Two',
                'address' => 'Jl. Merdeka No. 2',
                'description' => 'Deskripsi organisasi kedua',
                'city' => 'City B',
                'province' => 'Province B',
                'photo_file' => 'photo_2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
