<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'role-show',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-show',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'user-show',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'Customer_service_msg-show',
            'Customer_service_msg-list',
            'Customer_service_msg-create',
            'Customer_service_msg-edit',
            'Customer_service_msg-delete',
            'Contact-show',
            'Contact-list',
            'Contact-create',
            'Contact-edit',
            'Contact-delete',
            'Content-show',
            'Content-list',
            'Content-create',
            'Content-edit',
            'Content-delete',
            'Faq-show',
            'Faq-list',
            'Faq-create',
            'Faq-edit',
            'Faq-delete',
            'Banners-show',
            'Banners-list',
            'Banners-create',
            'Banners-edit',
            'Banners-delete',
            'Marketing-show',
            'Marketing-list',
            'Marketing-create',
            'Marketing-edit',
            'Marketing-delete',
            'Sales-show',
            'Sales-list',
            'Sales-create',
            'Sales-edit',
            'Sales-delete',
            'Notifications-show',
            'Notifications-list',
            'Notifications-create',
            'Notifications-edit',
            'Notifications-delete',
            'System_errors-show',
            'System_errors-list',
            'System_errors-create',
            'System_errors-edit',
            'System_errors-delete',
            'Users_types-show',
            'Users_types-list',
            'Users_types-create',
            'Users_types-edit',
            'Users_types-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
