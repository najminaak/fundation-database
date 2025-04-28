<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntrepreneursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('entrepreneurs')->delete();  // Hapus data lama sebelum seeding

        DB::table('entrepreneurs')->insert([
            [
                'user_id' => 3,  // user_id yang sudah ada di tabel users
                'mitra_id' => 1,  // mitra_id yang sudah ada di tabel mitras
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,  // user_id yang sudah ada di tabel users
                'mitra_id' => 2,  // mitra_id yang sudah ada di tabel mitras
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
