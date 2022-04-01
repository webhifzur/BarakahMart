<?php

namespace Database\Factories;

use App\Models\ShopCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ShopCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShopCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $icon_image ='category/'.Str::random(5).'png';
        $icon_image_location = 'uploads/' . $icon_image;
        $icon_image_name = $this->faker->image;
        Image::make($icon_image_name)->resize(25,25)->save(public_path($icon_image_location));



        $image ='category/'.Str::random(5).'png';
        $image_location = 'uploads/' . $image;
        $image_name = $this->faker->image;
        Image::make($image_name)->resize(252, 176)->save(public_path($image_location));

        return [
            'type' => $this->faker->text(10),
            'slug' => $this->faker->text(5) . '-' . Str::random(5),
            'icon_image' => $icon_image,
            'image' => $image,
        ];
    }
}
