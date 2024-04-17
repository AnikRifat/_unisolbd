<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = [
            'logo' => '',
            'phone_one' => '01711128828',
            'phone_two' => '01711128828',
            'about_us' => " Oxitech is considered the most trusted laptop shop in BD, allowing you to buy the best laptops from top laptop brands in the world. Along with the best laptop ",
            'email' => '',
            'company_name' => '',
            'company_address' => '',
            'copyright' => 'oxitech',
        ];
        SiteSetting::insert($setting);
    }
}
