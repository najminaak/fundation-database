<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventFundsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('event_funds')->insert([
            [
                'events_id' => 3, // pastikan ID 1 ada di tabel `events`
                'target_fund' => 700000000,
                'sponsor_deadline' => now()->addDays(30),
            ],
            // [
            //     'events_id' => 2,
            //     'target_fund' => 50000000,
            //     'sponsor_deadline' => now()->addDays(45),
            // ]
        ]);
    }
}
