<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_role')->truncate();

        $permissions = DB::table('permissions')->get();

        if ($permissions) {
            foreach ($permissions as $permission) {
                DB::table('permissions')->delete($permission->id);
            }
        }

        $arrayPermission = [
            [
                'name' => 'Permission View',
                'permission' => 'permission_index'
            ],
            [
                'name' => 'Permission Create',
                'permission' => 'permission_create'
            ],
            [
                'name' => 'Permission Edit',
                'permission' => 'permission_edit'
            ],
            [
                'name' => 'Permission Delete',
                'permission' => 'permission_delete'
            ],
            [
                'name' => 'Role View',
                'permission' => 'role_index'
            ],
            [
                'name' => 'Role Create',
                'permission' => 'role_create'
            ],
            [
                'name' => 'Role Edit',
                'permission' => 'role_edit'
            ],
            [
                'name' => 'Role Delete',
                'permission' => 'role_delete'
            ],
            [
                'name' => 'User View',
                'permission' => 'user_index'
            ],
            [
                'name' => 'User Create',
                'permission' => 'user_create'
            ],
            [
                'name' => 'User Edit',
                'permission' => 'user_edit'
            ],
            [
                'name' => 'User Delete',
                'permission' => 'user_delete'
            ],
            [
                'name' => 'Category',
                'permission' => 'category_index'
            ],
            [
                'name' => 'Category Create',
                'permission' => 'category_create'
            ],
            [
                'name' => 'Category Edit',
                'permission' => 'category_edit'
            ],
            [
                'name' => 'Category delete',
                'permission' => 'category_delete'
            ],
            [
                'name' => 'Banner Index',
                'permission' => 'banner_index'
            ],
            [
                'name' => 'Banner Create',
                'permission' => 'banner_create'
            ],
            [
                'name' => 'Banner Edit',
                'permission' => 'banner_edit'
            ],
            [
                'name' => 'Banner Delete',
                'permission' => 'banner_delete'
            ],
            [
                'name' => 'Product View',
                'permission' => 'product_index'
            ],
            [
                'name' => 'Product Create',
                'permission' => 'product_create'
            ],
            [
                'name' => 'Product Edit',
                'permission' => 'product_edit'
            ],
            [
                'name' => 'Product Delete',
                'permission' => 'product_delete'
            ],
            [
                'name' => 'Brand View',
                'permission' => 'brand_index'
            ],
            [
                'name' => 'Brand Create',
                'permission' => 'brand_create'
            ],
            [
                'name' => 'Brand Edit',
                'permission' => 'brand_edit'
            ],
            [
                'name' => 'Brand Delete',
                'permission' => 'brand_delete'
            ],
            [
                'name' => 'Store View',
                'permission' => 'store_index'
            ],
            [
                'name' => 'Store Create',
                'permission' => 'store_create'
            ],
            [
                'name' => 'Store Edit',
                'permission' => 'store_edit'
            ],
            [
                'name' => 'Store Delete',
                'permission' => 'store_delete'
            ],
            [
                'name' => 'Warehouses View',
                'permission' => 'warehouse_index'
            ],
            [
                'name' => 'Warehouses Detail',
                'permission' => 'warehouse_detail'
            ],
            [
                'name' => 'Purchases View',
                'permission' => 'purchases_index'
            ],
            [
                'name' => 'Purchases Create',
                'permission' => 'purchases_create'
            ],
            [
                'name' => 'Purchases Edit',
                'permission' => 'purchases_edit'
            ],
            [
                'name' => 'Purchases Delete',
                'permission' => 'purchases_delete'
            ],
            [
                'name' => 'Purchases Payment',
                'permission' => 'purchases_payment'
            ],
            [
                'name' => 'Purchases Detail',
                'permission' => 'purchases_detail'
            ],
            [
                'name' => 'Transfers View',
                'permission' => 'transfers_index'
            ],
            [
                'name' => 'Transfers Create',
                'permission' => 'transfers_create'
            ],
            [
                'name' => 'Transfers Edit',
                'permission' => 'transfers_edit'
            ],
            [
                'name' => 'Transfers Delete',
                'permission' => 'transfers_delete'
            ],
            [
                'name' => 'Transfers Confirm',
                'permission' => 'transfers_confirm'
            ],
            [
                'name' => 'Quotation Index',
                'permission' => 'quotation_index'
            ],
            [
                'name' => 'Feed Index',
                'permission' => 'feed_index'
            ],
            [
                'name' => 'Feed Mapping',
                'permission' => 'feed_mapping'
            ],
            [
                'name' => 'Feed Upfile',
                'permission' => 'feed_upfile'
            ],
            [
                'name' => 'Order View',
                'permission' => 'order_index'
            ],
            [
                'name' => 'Order Detail',
                'permission' => 'order_detail'
            ],
            [
                'name' => 'Order Delete',
                'permission' => 'order_delete'
            ],
            [
                'name' => 'Customer View',
                'permission' => 'customer_index'
            ],
            [
                'name' => 'Customer Create',
                'permission' => 'customer_create'
            ],
            [
                'name' => 'Customer Edit',
                'permission' => 'customer_edit'
            ],
            [
                'name' => 'Customer Delete',
                'permission' => 'customer_delete'
            ],
            [
                'name' => 'POS Index',
                'permission' => 'pos_index'
            ],
            [
                'name' => 'Dashboard Index',
                'permission' => 'dashboard_index'
            ],
        ];

        foreach ($arrayPermission as $permission) {
            $data = [
                'name' => $permission['name'],
                'permission' => $permission['permission']
            ];

            \App\Models\Permission::create($data);
        }
    }
}
