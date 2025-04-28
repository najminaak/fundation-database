<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventPhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('event_photos')->insert([
            [
                'events_id' => 1, // pastikan ID event 1 ada
                'photo_file' => 'event1_photo1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'events_id' => 1,
                'photo_file' => 'event1_photo2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'events_id' => 2,
                'photo_file' => 'event2_photo1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
