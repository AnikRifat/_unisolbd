<?php

namespace Database\Seeders;

use App\Models\Submenu;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $submenu = [

            //category
            [
                'name' => 'Category',
                'icon' => 'fa-stop',
                "route" =>"category.index",
                'module_id' => 1,
                'menu_id' => 3,
                'ordering' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Subcategory',
                'icon' => 'fa-stop',
                "route" =>"subcategory.create",
                'module_id' => 1,
                'menu_id' => 3,
                'ordering' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Subsubcategory',
                'icon' => 'fa-stop',
                "route" =>"subsubcategory.create",
                'module_id' => 1,
                'menu_id' => 3,
                'ordering' => 3,
                'created_at' => Carbon::now(),
            ],

            //quotation
            [
                'name' => 'Create Quotation Package',
                'icon' => 'fa-stop',
                "route" =>"package.index",
                'module_id' => 1,
                'menu_id' => 4,
                'ordering' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Create Quotation',
                'icon' => 'fa-stop',
                "route" =>"quotation.create",
                'module_id' => 1,
                'menu_id' => 4,
                'ordering' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Quotation List',
                'icon' => 'fa-stop',
                "route" =>"quotation.index",
                'module_id' => 1,
                'menu_id' => 4,
                'ordering' => 3,
                'created_at' => Carbon::now(),
            ],

            //product
            [
                'name' => 'Specification',
                'icon' => 'fa-stop',
                "route" =>"specification.index",
                'module_id' => 1,
                'menu_id' => 5,
                'ordering' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Specification Details',
                'icon' => 'fa-stop',
                "route" =>"specification-detail.create",
                'module_id' => 1,
                'menu_id' => 5,
                'ordering' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Product Unit',
                'icon' => 'fa-stop',
                "route" =>"unit.index",
                'module_id' => 1,
                'menu_id' => 5,
                'ordering' => 3,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Add Product',
                'icon' => 'fa-stop',
                "route" =>"product.create",
                'module_id' => 1,
                'menu_id' => 5,
                'ordering' => 4,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Product List',
                'icon' => 'fa-stop',
                "route" =>"product.index",
                'module_id' => 1,
                'menu_id' => 5,
                'ordering' => 5,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Print Barcode',
                'icon' => 'fa-stop',
                "route" =>"barcode.create",
                'module_id' => 1,
                'menu_id' => 5,
                'ordering' => 6,
                'created_at' => Carbon::now(),
            ],


            //shipping area
            [
                'name' => 'Division',
                'icon' => 'fa-stop',
                "route" =>"manage-division",
                'module_id' => 1,
                'menu_id' => 6,
                'ordering' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'District',
                'icon' => 'fa-stop',
                "route" =>"manage-district",
                'module_id' => 1,
                'menu_id' => 6,
                'ordering' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'State',
                'icon' => 'fa-stop',
                "route" =>"manage-state",
                'module_id' => 1,
                'menu_id' => 6,
                'ordering' => 3,
                'created_at' => Carbon::now(),
            ],

             //order
             [
                'name' => 'All Users',
                'icon' => 'fa-stop',
                "route" =>"user-management.index",
                'module_id' => 1,
                'menu_id' => 9,
                'ordering' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Pending Users',
                'icon' => 'fa-stop',
                "route" =>"user-management.pending",
                'module_id' => 1,
                'menu_id' => 9,
                'ordering' => 2,
                'created_at' => Carbon::now(),
            ],

            //purchase
            [
                'name' => 'Add Purchase',
                'icon' => 'fa-stop',
                "route" =>"create.purchase",
                'module_id' => 2,
                'menu_id' => 10,
                'ordering' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Purchase List',
                'icon' => 'fa-stop',
                "route" =>"view.purchase",
                'module_id' => 2,
                'menu_id' => 10,
                'ordering' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Due Collection',
                'icon' => 'fa-stop',
                "route" =>"purchase-due-collection",
                'module_id' => 2,
                'menu_id' => 10,
                'ordering' => 3,
                'created_at' => Carbon::now(),
            ],

              //sale
              [
                'name' => 'Add Sale',
                'icon' => 'fa-stop',
                "route" =>"create.sale",
                'module_id' => 2,
                'menu_id' => 11,
                'ordering' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Sale List',
                'icon' => 'fa-stop',
                "route" =>"view.sale",
                'module_id' => 2,
                'menu_id' => 11,
                'ordering' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Due Collection',
                'icon' => 'fa-stop',
                "route" =>"sale-due-collection",
                'module_id' => 2,
                'menu_id' => 11,
                'ordering' => 3,
                'created_at' => Carbon::now(),
            ],

            //report
            [
                'name' => 'Purchase Report',
                'icon' => 'fa-stop',
                "route" =>"create.purchase-report",
                'module_id' => 2,
                'menu_id' => 13,
                'ordering' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Sale Report',
                'icon' => 'fa-stop',
                "route" =>"create.sale-report",
                'module_id' => 2,
                'menu_id' => 13,
                'ordering' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Inventory Report',
                'icon' => 'fa-stop',
                "route" =>"create.inventory-report",
                'module_id' => 2,
                'menu_id' => 13,
                'ordering' => 3,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Supplier Wise Report',
                'icon' => 'fa-stop',
                "route" =>"create.supplier-report",
                'module_id' => 2,
                'menu_id' => 13,
                'ordering' => 4,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Cutomer Wise Report',
                'icon' => 'fa-stop',
                "route" =>"create.customer-report",
                'module_id' => 2,
                'menu_id' => 13,
                'ordering' => 5,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Expense Report',
                'icon' => 'fa-stop',
                "route" =>"create.expense-report",
                'module_id' => 2,
                'menu_id' => 13,
                'ordering' => 6,
                'created_at' => Carbon::now(),
            ],

            //administration
            [
                'name' => 'Role Permission',
                'icon' => 'fa-stop',
                "route" =>"role.index",
                'module_id' => 3,
                'menu_id' => 14,
                'ordering' => 1,
                'created_at' => Carbon::now(),
            ],

            [
                'name' => 'User Management',
                'icon' => 'fa-stop',
                "route" =>"user-management.index",
                'module_id' => 3,
                'menu_id' => 14,
                'ordering' => 2,
                'created_at' => Carbon::now(),
            ],





        ];

        Submenu::insert($submenu);
    }
}
