<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  \App\Models\Admin::factory()->create();
        //  \App\Models\SiteSetting::factory()->create();
        //  \App\Models\Seo::factory()->create();
        //  \App\Models\Currency::factory()->create();
       
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);



        $this->call([
            AdminSeeder::class,
            CurrencySeeder::class,
            SeoSeeder::class,
            SiteSettingSeeder::class,
            ModuleSeeder::class,
            MenuSeeder::class,
            SubmenuSeeder::class,
            PermissionSeeder::class,

    ]);
    }
}
