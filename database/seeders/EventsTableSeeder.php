<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'organizers_id' => 1, // pastikan ID ini ada di tabel organizations
                'title' => 'Tech Conference 2025',
                'type_event' => 'Conference',
                'status_event' => 'Upcoming',
                'target_participant' => 500,
                'description' => 'An annual technology conference for developers and tech enthusiasts.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organizers_id' => 1,
                'title' => 'Startup Pitch Day',
                'type_event' => 'Competition',
                'status_event' => 'Open Registration',
                'target_participant' => 100,
                'description' => 'A pitch event for early-stage startups to get funding and exposure.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
