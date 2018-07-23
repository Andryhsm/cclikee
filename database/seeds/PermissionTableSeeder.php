<?php

use Illuminate\Database\Seeder;

Class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Dashboard',
            'parent_id' => NULL,
            'route' => 'dashboard'
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Products',
            'parent_id' => NULL,
            'route' => NULL
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'CMS',
            'parent_id' => NULL,
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Account',
            'parent_id' => NULL,
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Claim Management',
            'parent_id' => NULL,
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Finance',
            'parent_id' => NULL,
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Sales',
            'parent_id' => NULL,
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Product Manager',
            'parent_id' => 2,
            'route' => 'product,create_product,edit_product'
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Product Rating Manager',
            'parent_id' => 2,
            'route' => 'product-rating.index,product-rating.edit'
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Category Manager',
            'parent_id' => 2,
            'route' => 'category'
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Brand Manager',
            'parent_id' => 2,
            'route' => 'brand.index,brand.create,brand.edit'
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Attribute',
            'parent_id' => 2,
            'route' => 'attribute,create_attribute,edit_attribute'
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Attribute Set',
            'parent_id' => 2,
            'route' => 'attribute_set,create_attribute_set,edit_attribute_set'
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Special Product',
            'parent_id' => 2,
            'route' => 'special-product.index,special-product.create,special-product.edit'
        ]);


        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Page Manager',
            'parent_id' => 3,
            'route' => 'page.index,page.create,page.edit'
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Email/SMS Template',
            'parent_id' => 3,
            'route' => 'email-template.index,email-template.create,email-template.edit'
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Coupon Manager',
            'parent_id' => 3,
            'route' => 'coupon'
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Banner Manager',
            'parent_id' => 3,
            'route' => 'banner.index,banner.create,banner.edit'
        ]);

        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Customer',
            'parent_id' => 4,
            'route' => 'customer.index,customer.create,customer.edit'
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Merchant',
            'parent_id' => 4,
            'route' => 'store.index,store.create,store.edit'
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Admin',
            'parent_id' => 4,
            'route' => 'administrator,add_administrator,edit_administrator'
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Role',
            'parent_id' => 4,
            'route' => 'role.index,role.create,role.edit'
        ]);

        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Price Adjustment',
            'parent_id' => 5,
            'route' => 'price_adjustment'
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Product Enhancement',
            'parent_id' => 5,
            'route' => 'price_adjustment'
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Link Adjustment',
            'parent_id' => 5,
            'route' => 'affiliate.index,affiliate.create,affiliate.edit'
        ]);

        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Product Billed',
            'parent_id' => 6,
            'route' => 'product_billed'
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Invoices',
            'parent_id' => 6,
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Company Account',
            'parent_id' => 6,
            'route' => 'company_account'
        ]);

        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Ongoing',
            'parent_id' => 7,
            'route' => 'orders,orders_detail'
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Completed',
            'parent_id' => 7,
            'route' => 'orders,orders_detail'
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Special Ask',
            'parent_id' => 7,
            'route' => 'orders,orders_detail'
        ]);
        factory(\App\Models\Permission::class)->create([
            'module_name' => 'Order Status',
            'parent_id' => 7,
            'route' => 'order-status.index,order-status.create,order-status.edit'
        ]);
    }
}
