<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $image = 'product/'.Str::random(5)."."."png";
        $image_location = 'uploads/' . $image;
        $image_name = $this->faker->image;
        Image::make($image_name)->resize(700 ,700)->save(public_path($image_location));

        for ($j=1; $j <= 5 ; $j++) { 
            $slider_image = 'product_slider/'.Str::random(5)."."."png";
            $slider_image_location = 'uploads/' . $slider_image;
            $slider_image_name = $this->faker->image;
            Image::make($slider_image_name)->resize(700 ,700)->save(public_path($slider_image_location));
            $data[] = $slider_image;
        }
        return [
            'name' => $this->faker->text(10),
            'product_coad' => $this->faker->unique()->randomNumber,
            'image' => $image,
            'slider_image' => json_encode($data),
            'small_description' => $this->faker->text(10),
            'long_description' => $this->faker->text(500),
            'brand' => $this->faker->numberBetween(1,10),
            'unit' => $this->faker->numberBetween(1,5),
            'sell_price' => $this->faker->numberBetween(25,2000),
            'qty' => $this->faker->numberBetween(25,200),
            'shop_type' => $this->faker->numberBetween(1,10),
            'subcategory' => $this->faker->numberBetween(1,25),
            'slug' => $this->faker->text(5) . '-' . Str::random(5),
            'status' => 1,
        ];
    }
}
