<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('event_categories')->insert([
            [
                'events_id' => 1, // pastikan ID event ini ada
                'event_category_names_id' => 1, // contoh: 'Technology'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'events_id' => 1,
                'event_category_names_id' => 3, // contoh: 'AI & Machine Learning' (subkategori dari Technology)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'events_id' => 2,
                'event_category_names_id' => 2, // contoh: 'Education'
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
