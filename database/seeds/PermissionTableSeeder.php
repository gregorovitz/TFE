<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
            'user-edit',
            'user-list',
            'user-change-role',
            'permission-list',
            'permission-create',
            'permission-edit',
            'display-intern-calendar'

        ];


        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $role=Role::create(['name'=>'visitor'])->givePermissionTo('user-edit');
        $roleA=Role::create(['name'=>'super-admin'])->givePermissionTo([Permission::all()]);
    }
}
