<?php

namespace Database\Seeders;

use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            [
                'menu_id' => 0,
                'name' => 'Create',
                'created_at' => Carbon::now(),
            ],
            [
                'menu_id' => 0,
                'name' => 'View',
                'created_at' => Carbon::now(),
            ],
            [
                'menu_id' => 0,
                'name' => 'Edit',
                'created_at' => Carbon::now(),
            ],
            [
                'menu_id' => 0,
                'name' => 'Update',
                'created_at' => Carbon::now(),
            ],
            [
                'menu_id' => 0,
                'name' => 'Print',
                'created_at' => Carbon::now(),
            ]
        ];

        Permission::insert($permission);
    }
}
