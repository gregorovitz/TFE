<?php

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
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'form-list',
            'form-edit',
            'customer-list',
            'customer-create',
            'customer-edit',
            'customer-delete',
            'intervention-list',
            'intervention-create',
            'intervention-edit',
            'intervention-delete',
            'site-list',
            'site-create',
            'site-edit',
            'site-delete',
            'site-display',
            'template-list',
            'template-create',
            'template-edit',
            'template-display',
            'template-previous',
            'type-list',
            'type-create',
            'type-edit',
            'type-delete',
            'user-edit',
            'user-list',
            'user-change-role'
        ];


        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
