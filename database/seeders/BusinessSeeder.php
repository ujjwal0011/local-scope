<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Business;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Business::insert([
            [
                'user_id' => 1,
                'name' => 'Pizza Hut',
                'description' => 'Delicious pizzas',
                'address' => 'Sector 62, Noida',
                'latitude' => '28.6304',
                'longitude' => '77.3739',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'Reliance Digital',
                'description' => 'Electronics and gadgets',
                'address' => 'DLF Mall, Delhi',
                'latitude' => '28.5672',
                'longitude' => '77.3210',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'H&M',
                'description' => 'Fashion clothing',
                'address' => 'Ambience Mall, Gurgaon',
                'latitude' => '28.5042',
                'longitude' => '77.0961',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add some businesses close to your current location
            [
                'user_id' => 1,
                'name' => 'Local Restaurant',
                'description' => 'Traditional cuisine',
                'address' => 'Near your location',
                'latitude' => '31.2510138',  // Your current location
                'longitude' => '75.6997592', // Your current location
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'Electronics Store',
                'description' => 'Latest gadgets',
                'address' => 'Near your location',
                'latitude' => '31.2510138', // Your current location
                'longitude' => '75.7097592', // Slightly offset to be nearby
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'Fashion Boutique',
                'description' => 'Trendy clothing',
                'address' => 'Near your location',
                'latitude' => '31.2610138', // Slightly offset to be nearby
                'longitude' => '75.6997592', // Your current location
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'Cafe Bliss',
                'description' => 'Cozy cafe with desserts',
                'address' => 'Model Town Market',
                'latitude' => '31.248500',
                'longitude' => '75.704900',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'Techie Mobiles',
                'description' => 'Latest smartphones and accessories',
                'address' => 'Urban Estate Phase 1',
                'latitude' => '31.238000',
                'longitude' => '75.710000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'FitZone Gym',
                'description' => 'Modern fitness center',
                'address' => 'Civil Lines, Jalandhar',
                'latitude' => '31.255000',
                'longitude' => '75.718000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'Beauty Bay Salon',
                'description' => 'Professional salon services',
                'address' => 'BMC Chowk',
                'latitude' => '31.34536',
                'longitude' => '75.48671',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'The Book Nook',
                'description' => 'Books, coffee and more',
                'address' => 'Shastri Market',
                'latitude' => '31.423754',
                'longitude' => '75.411209',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'PVR Friends',
                'description' => 'Multiplex with food court',
                'address' => 'GTB Nagar',
                'latitude' => '31.31418',
                'longitude' => '75.59106',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
