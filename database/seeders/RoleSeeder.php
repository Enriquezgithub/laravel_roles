<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Permission::create(['name' => 'create_product']);
        Permission::create(['name' => 'update_product']);
        Permission::create(['name' => 'delete_product']);
        Permission::create(['name' => 'show_product']);
        Permission::create(['name' => 'export_product']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(['create_product', 'update_product', 'delete_product', 'show_product', 'export_product']);

        $role1 = Role::create(['name' => 'writer']);
        $role1->givePermissionTo(['show_product', 'update_product', 'export_product']);

        $role2 = Role::create(['name' => 'user']);
        $role2->givePermissionTo('export_product');
    }
}
