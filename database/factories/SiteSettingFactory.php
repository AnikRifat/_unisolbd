<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SiteSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'logo' => '',
            'phone_one' => '01711128828',
            'phone_two' => '01711128828',
            'about_us' => " Oxitech is considered the most trusted laptop shop in BD, allowing you to buy the best laptops from top laptop brands in the world. Along with the best laptop ",
            'email' => '',
            'company_name' => '',
            'company_address' => '',
            'copyright' => 'oxitech',
        ];
    }
}
