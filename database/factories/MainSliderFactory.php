<?php

namespace Database\Factories;

use App\Models\MainSlider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class MainSliderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MainSlider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $image = 'slider/'.Str::random(5)."."."png";
        $image_location = 'uploads/' . $image;
        $image_name = $this->faker->image;
        Image::make($image_name)->resize(1100, 400)->save(public_path($image_location));

        return [
            'image' => $image,
        ];
    }
}
