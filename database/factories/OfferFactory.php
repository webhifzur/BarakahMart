<?php

namespace Database\Factories;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class OfferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Offer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $image = 'offer/'.Str::random(5)."."."png";
        $image_location = 'uploads/' . $image;
        $image_name = $this->faker->image;
        Image::make($image_name)->resize(320, 180)->save(public_path($image_location));

        return [
            'product_id' => $this->faker->numberBetween(1,100),
            'image' => $image,
        ];
    }
}
