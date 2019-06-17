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
            //'display-intern-calendar',
            'display-calendar',
            'validate-event',
            'print-event',
            'edit-event',
            //'show-event-interne',
            'show-event',
            'show-room',
            'create-room',
            'edit-room',
            //'show-typeEvent',
            //'create-typeEvent',
            //'edit-typeEvent',
            'show-organisation',
            'create-organisation',
            'edit-organisation',
            'payment-validation-event',
            'display-intern-calendar',
            'create-event',
            'list-event',
            'user-show'


        ];


        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $role=Role::create(['name'=>'visitor'])->givePermissionTo('user-edit','display-calendar','create-event');
        $roleA=Role::create(['name'=>'Admin'])->givePermissionTo([Permission::all()]);
        $role=Role::create(['name'=>'gestionnaire de salle'])->givePermissionTo('user-edit','display-calendar','display-intern-calendar','validate-event','print-event','edit-event','show-event','show-room','create-room','edit-room','show-organisation','create-organisation','edit-organisation','create-event');
        $role=Role::create(['name'=>'trésorier'])->givePermissionTo('user-edit','display-calendar','display-intern-calendar','validate-event','print-event','edit-event','show-event','show-room','create-room','edit-room','show-organisation','create-organisation','edit-organisation','create-event','payment-validation-event');
    }
}
