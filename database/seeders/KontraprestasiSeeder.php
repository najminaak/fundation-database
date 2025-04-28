<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kontraprestasi;

class KontraprestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kontraprestasi::create([
            'events_id' => 1, // Pastikan ID event valid
            'icon_photo_kontraprestasis_id' => 1, // Pastikan ID icon_photo_kontraprestasi valid
            'title' => 'Kontraprestasi Pertama',
            'min_sponsor' => 1000000, // Minimal sponsor
            'max_sponsor' => 5000000, // Maksimal sponsor
            'feedback' => 'Feedback positif tentang kontraprestasi pertama.',
        ]);

        Kontraprestasi::create([
            'events_id' => 2, // Pastikan ID event valid
            'icon_photo_kontraprestasis_id' => 2, // Pastikan ID icon_photo_kontraprestasi valid
            'title' => 'Kontraprestasi Kedua',
            'min_sponsor' => 2000000, // Minimal sponsor
            'max_sponsor' => 6000000, // Maksimal sponsor
            'feedback' => 'Feedback positif tentang kontraprestasi kedua.',
        ]);

        Kontraprestasi::create([
            'events_id' => 3, // Pastikan ID event valid
            'icon_photo_kontraprestasis_id' => 2, // Pastikan ID icon_photo_kontraprestasi valid
            'title' => 'Kontraprestasi Kedua',
            'min_sponsor' => 2000000, // Minimal sponsor
            'max_sponsor' => 6000000, // Maksimal sponsor
            'feedback' => 'Feedback positif tentang kontraprestasi kedua.',
        ]);

    }
}
