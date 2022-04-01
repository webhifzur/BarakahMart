<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Setting::factory(1)->create();
        \App\Models\MainSlider::factory(5)->create();
        \App\Models\ShopCategory::factory(12)->create();
        \App\Models\SubCategory::factory(25)->create();
        \App\Models\Unit::factory(5)->create();
        \App\Models\Brand::factory(10)->create();
        \App\Models\Product::factory(100)->create();
        \App\Models\Offer::factory(8)->create();
    }
}
