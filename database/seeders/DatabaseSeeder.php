<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([     
            // UserSeeder::class,
            // UserDataSeeder::class,
            // OrganizationsTableSeeder::class,
            // OrganizersTableSeeder::class,
            // EventsTableSeeder::class,
            // MitrasTableSeeder::class,  
            // EventFundsTableSeeder::class,
            // EventPlacementsTableSeeder::class,
            // EventPhotosTableSeeder::class,
            // EventCategoryNamesTableSeeder::class,
            // EventCategoriesTableSeeder::class,
            // EntrepreneursTableSeeder::class,  
            KontraprestasiSeeder::class,     

        ]);
    }
    
}
