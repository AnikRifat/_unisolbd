<?php

namespace Database\Seeders;

use App\Models\Module;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            [
                'name' => 'E-Commerce',
                'icon' => 'fa-shopping-cart',
                'bg_color' => 'btn-info',
                'ordering' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'POS',
                'icon' => 'fa-calculator',
                'bg_color' => 'btn-success',
                'ordering' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Settings',
                'icon' => 'fa-gear',
                'bg_color' => 'btn-warning',
                'ordering' => 3,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Landing Page',
                'icon' => 'fa-stop',
                'bg_color' => 'btn-primary',
                'ordering' => 4,
                'created_at' => Carbon::now(),
            ],
           
        ];

        Module::insert($modules);
    }
}
