<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $menu_logo = 'setting/' . Str::random(5)."."."png";
        $menu_logo_location = 'uploads/' . $menu_logo;
        $menu_logo_name = $this->faker->image;
        Image::make($menu_logo_name)->resize(200, 65)->save(public_path($menu_logo_location));


        $footer_logo = 'setting/' . Str::random(5)."."."png";
        $footer_logo_location = 'uploads/' . $footer_logo;
        $footer_logo_name = $this->faker->image;
        Image::make($footer_logo_name)->resize(275, 155)->save(public_path($footer_logo_location));


        $innerpage = 'setting/' . Str::random(5)."."."png";
        $innerpage_location = 'uploads/' . $innerpage;
        $innerpage_name = $this->faker->image;
        Image::make($innerpage_name)->resize(1300, 400)->save(public_path($innerpage_location));

        return [
            'c_title' => 'Product Categories',
            'p_title' => 'Products',
            'p_subtitle' => 'lowest price!',
            'offer_title' => 'Special Offers',
            'footer_description' => $this->faker->text(500),
            'phone_one' => $this->faker->phoneNumber,
            'whatsapp' => $this->faker->phoneNumber,
            'facebook' => 'https://www.facebook.com/barakahmart',
            'menu_logo' => $menu_logo,
            'footer_logo' => $footer_logo,
            'innerpage' => $innerpage,
        ];
    }
}