<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $see_users = new Permission();
		$see_users->name = 'see_users';
		$see_users->display_name = 'see users';
		$see_users->save();

		$see_roles = new Permission();
		$see_roles->name = 'see_roles';
		$see_roles->display_name = 'see roles';
		$see_roles->save();

		$create_roles = new Permission();
		$create_roles->name = 'create_roles';
		$create_roles->display_name = 'create roles';
		$create_roles->save();

		$create_users = new Permission();
		$create_users->name = 'create_users';
		$create_users->display_name = 'create users';
		$create_users->save();

		$edit_roles = new Permission();
		$edit_roles->name = 'edit_roles';
		$edit_roles->display_name = 'edit roles';
		$edit_roles->save();

		$edit_users = new Permission();
		$edit_users->name = 'edit_users';
		$edit_users->display_name = 'edit users';
		$edit_users->save();

		$delete_users = new Permission();
		$delete_users->name = 'delete_users';
		$delete_users->display_name = 'delete users';
		$delete_users->save();

		$delete_roles = new Permission();
		$delete_roles->name = 'delete_roles';
		$delete_roles->display_name = 'delete roles';
		$delete_roles->save();
    }
}
