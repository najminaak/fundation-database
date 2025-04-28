<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventCategoryNamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kategori utama
        DB::table('event_category_names')->insert([
            [
                'id' => 1,
                'name' => 'Technology',
                'parent_id' => null,
                'icon' => 'cpu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Education',
                'parent_id' => null,
                'icon' => 'book',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Subkategori
        DB::table('event_category_names')->insert([
            [
                'name' => 'AI & Machine Learning',
                'parent_id' => 1,
                'icon' => 'brain',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Web Development',
                'parent_id' => 1,
                'icon' => 'globe',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Online Courses',
                'parent_id' => 2,
                'icon' => 'monitor',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
