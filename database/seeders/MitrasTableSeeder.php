<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MitrasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mitras')->delete();  // Hapus data lama sebelum seeding

        DB::table('mitras')->insert([
            [
                'id' => 1,
                'name' => 'Mitra One',
                'address' => 'Alamat Mitra One',
                'city' => 'Kota One',
                'province' => 'Provinsi One', // Menambahkan value untuk province
                'photo_file' => 'foto_mitra_one.jpg', // Contoh nama file foto
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Mitra Two',
                'address' => 'Alamat Mitra Two',
                'city' => 'Kota Two',
                'province' => 'Provinsi Two', // Menambahkan value untuk province
                'photo_file' => 'foto_mitra_two.jpg', // Contoh nama file foto
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
