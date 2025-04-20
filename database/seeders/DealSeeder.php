<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Deal;

class DealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Deal::insert([
            [
                'title' => '50% off on pizzas',
                'description' => 'Only on weekends!',
                'discount' => 50.00,
                'business_id' => 1,
                'category_id' => 1,
            ],
            [
                'title' => '10% off on laptops',
                'description' => 'Back to school sale',
                'discount' => 10.00,
                'business_id' => 2,
                'category_id' => 2,
            ],
            [
                'title' => '20% off on all meals',
                'description' => 'Special offer for dine-in customers',
                'discount' => 20.00,
                'business_id' => 4,  // Local Restaurant
                'category_id' => 1,  // Food
            ],
            [
                'title' => '15% off on smartphones',
                'description' => 'Limited time offer',
                'discount' => 15.00,
                'business_id' => 5,  // Electronics Store
                'category_id' => 2,  // Electronics
            ],
            [
                'title' => 'Buy 1 Get 1 Free',
                'description' => 'On selected clothing items',
                'discount' => 50.00,
                'business_id' => 6,  // Fashion Boutique
                'category_id' => 3,  // Fashion
            ],
            [
                'title' => 'Free dessert with coffee',
                'description' => 'Enjoy a dessert free with any coffee purchase',
                'discount' => 100.00,
                'business_id' => 7,
                'category_id' => 1, // Food
            ],
            [
                'title' => '25% off on phone covers',
                'description' => 'Trendy covers for all phone models',
                'discount' => 25.00,
                'business_id' => 8,
                'category_id' => 2, // Electronics
            ],
            [
                'title' => 'Monthly pass at ₹999',
                'description' => 'Unlimited gym access for a month',
                'discount' => 30.00,
                'business_id' => 9,
                'category_id' => 5, // Fitness
            ],
            [
                'title' => 'Haircut + Styling at ₹499',
                'description' => 'Get a stylish look at a discounted rate',
                'discount' => 35.00,
                'business_id' => 10,
                'category_id' => 4, // Beauty
            ],
            [
                'title' => 'Buy 2 Get 1 Free on bestsellers',
                'description' => 'Available on select titles',
                'discount' => 33.33,
                'business_id' => 11,
                'category_id' => 6, // Books
            ],
            [
                'title' => 'Flat ₹100 off on movie tickets',
                'description' => 'Applicable on all evening shows',
                'discount' => 20.00,
                'business_id' => 12,
                'category_id' => 7, // Entertainment
            ],
        ]);
    }
}
