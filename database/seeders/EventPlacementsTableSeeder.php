<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventPlacementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('event_placements')->insert([
            [
                'events_id' => 1, // pastikan ID ini sesuai dengan tabel events
                'event_start_date' => Carbon::parse('2025-06-10'),
                'event_end_date' => Carbon::parse('2025-06-12'),
                'event_venue' => 'Jakarta Convention Center',
                'address' => 'Jl. Gatot Subroto No.1, Jakarta',
                'city' => 'Jakarta',
                'province' => 'DKI Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'events_id' => 2,
                'event_start_date' => Carbon::parse('2025-07-20'),
                'event_end_date' => Carbon::parse('2025-07-21'),
                'event_venue' => 'Bandung Creative Hub',
                'address' => 'Jl. Laswi No.7, Bandung',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
