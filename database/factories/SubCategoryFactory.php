<?php

namespace Database\Factories;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SubCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $image ='subcategory/'.Str::random(5).'png';
        $image_location = 'uploads/' . $image;
        $image_name = $this->faker->image;
        Image::make($image_name)->resize(252, 176)->save(public_path($image_location));

        return [
            'type' => $this->faker->text(10),
            'shop_type' => $this->faker->numberBetween(1,10),
            'slug' => $this->faker->text(5) . '-' . Str::random(5),
            'image' => $image,
        ];
    }
}
