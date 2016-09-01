<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(App\User::class, 1)->create();
        $role = factory(App\Role::class,1)->create();
        $user->attachRole($role);
        $permissions = App\Permission::all();
        $role->attachPermissions($permissions);
    }
}
