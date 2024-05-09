<?php

namespace Database\Seeders;

use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [

            //e-commerce

            [
                'name' => 'Brand',
                'icon' => 'flag',
                'module_id' => 1,
                'ordering' => 1,
                'route' => 'brand.index',
                'prefix' => null,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Slider',
                'icon' => 'sliders',
                'module_id' => 1,
                'ordering' => 2,
                'route' => 'slider.index',
                'prefix' => null,
                'created_at' => Carbon::now(),
            ],

            [
                'name' => 'Categories',
                'icon' => 'list',
                'module_id' => 1,
                'ordering' => 3,
                'prefix' => '/productcatalog',
                'route' => null,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Quotation Builder',
                'icon' => 'save',
                'module_id' => 1,
                'ordering' => 4,
                'route' => null,
                'prefix' => '/dealflow',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Product',
                'icon' => 'box',
                'module_id' => 1,
                'ordering' => 5,
                'prefix' => '/product',
                'route' => null,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Shipping Area',
                'icon' => 'map-pin',
                'module_id' => 1,
                'ordering' => 6,
                'prefix' => '/shipping',
                'route' => null,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Coupon',
                'icon' => 'gift',
                'module_id' => 1,
                'route' => 'coupon.index',
                'prefix' => null,
                'ordering' => 7,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Order',
                'icon' => 'shopping-cart',
                'module_id' => 1,
                'prefix' => '/order',
                'route' => null,
                'ordering' => 8,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'User Management',
                'icon' => 'users',
                'module_id' => 1,
                'prefix' => '/use',
                'route' => null,
                'ordering' => 9,
                'created_at' => Carbon::now(),
            ],
            //pos

            [
                'name' => 'Vendor',
                'icon' => 'sliders',
                'route' => 'vendor.index',
                'prefix' => null,
                'module_id' => 2,
                'ordering' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Purchase',
                'icon' => 'shopping-bag',
                'module_id' => 2,
                'prefix' => '/purchase',
                'route' => null,
                'ordering' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Sale',
                'icon' => 'shopping-cart',
                'prefix' => '/sale',
                'route' => null,
                'module_id' => 2,
                'ordering' => 3,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Expense',
                'icon' => 'file-text',
                'prefix' => null,
                'route' => 'expense.index',
                'module_id' => 2,
                'ordering' => 4,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Report',
                'icon' => 'pie-chart',
                'prefix' => '/report',
                'route' => null,
                'module_id' => 2,
                'ordering' => 5,
                'created_at' => Carbon::now(),
            ],

            //settings

            [
                'name' => 'Administration',
                'icon' => 'users',
                'prefix' => '/administration',
                'route' => null,
                'module_id' => 3,
                'ordering' => 1,
                'created_at' => Carbon::now(),
            ],

            [
                'name' => 'Site',
                'icon' => 'settings',
                'prefix' => null,
                'route' => 'site-setting.index',
                'module_id' => 3,
                'ordering' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Seo',
                'icon' => 'globe',
                'prefix' => null,
                'route' => 'seo-setting.index',
                'module_id' => 3,
                'ordering' => 3,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Currency',
                'icon' => 'dollar-sign',
                'prefix' => null,
                'route' => 'currency.index',
                'module_id' => 3,
                'ordering' => 4,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Social Media',
                'icon' => 'send',
                'prefix' => null,
                'route' => 'social-media-setting.index',
                'module_id' => 3,
                'ordering' => 5,
                'created_at' => Carbon::now(),
            ],

            //Landing Page
            [
                'name' => 'Menu',
                'icon' => 'menu',
                'prefix' => null,
                'route' => 'menu.index',
                'module_id' => 4,
                'ordering' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Submenu',
                'icon' => 'link',
                'prefix' => null,
                'route' => 'submenu.create',
                'module_id' => 4,
                'ordering' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Subsubmenu',
                'icon' => 'link-2',
                'prefix' => null,
                'route' => 'subsubmenu.create',
                'module_id' => 4,
                'ordering' => 3,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Slider',
                'icon' => 'sliders',
                'prefix' => null,
                'route' => 'landing-page-slider.create',
                'module_id' => 4,
                'ordering' => 4,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Notice',
                'icon' => 'bell',
                'prefix' => null,
                'route' => 'notice.index',
                'module_id' => 4,
                'ordering' => 5,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'About Us',
                'icon' => 'info',
                'prefix' => null,
                'route' => 'about-us.index',
                'module_id' => 4,
                'ordering' => 6,
                'created_at' => Carbon::now(),
            ],
        ];

        Menu::insert($menus);
    }
}
