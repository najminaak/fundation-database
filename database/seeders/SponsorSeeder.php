<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sponsor;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sponsor::create([
            'event_id' => 1, // Pastikan ID event valid
            'amount' => 3000000, // Jumlah sponsor
            'enterpreneur_id' => 1, // Pastikan ID entrepreneur valid
        ]);

        Sponsor::create([
            'event_id' => 2, // Pastikan ID event valid
            'amount' => 20000, // Jumlah sponsor
            'enterpreneur_id' => 2, // Pastikan ID entrepreneur valid
        ]);

        Sponsor::create([
            'event_id' => 3, // Pastikan ID event valid
            'amount' => 5000, // Jumlah sponsor
            'enterpreneur_id' => 3, // Pastikan ID entrepreneur valid
        ]);
    }
}
