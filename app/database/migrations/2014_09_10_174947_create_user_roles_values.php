<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolesValues extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$role = new Role();
		$role->name = 'create_campaign';
		$role->description = 'Create a campaign';
		$role->save();

		$role = new Role();
		$role->name = 'edit_campaign';
		$role->description = 'Edit a campaign';
		$role->save();

		$role = new Role();
		$role->name = 'edit_others_campaign';
		$role->description = 'Edit others campaigns';
		$role->save();

		$role = new Role();
		$role->name = 'comment_on_campaign';
		$role->description = 'Comment on campaigns';
		$role->save();

		$role = new Role();
		$role->name = 'comment_on_others_campaign';
		$role->description = 'Comment on others campaigns';
		$role->save();

		$role = new Role();
		$role->name = 'approve_campaign';
		$role->description = 'Approve a campaign';
		$role->save();

		$role = new Role();
		$role->name = 'schedule_campaign';
		$role->description = 'Schedule a campaign';
		$role->save();

		$role = new Role();
		$role->name = 'view_campaigns';
		$role->description = 'View campaigns';
		$role->save();

		$role = new Role();
		$role->name = 'view_all_campaigns';
		$role->description = 'View all campaigns';
		$role->save();

		$role = new Role();
		$role->name = 'delete_campaign';
		$role->description = 'Delete campaign';
		$role->save();

		$role = new Role();
		$role->name = 'delete_others_campaigns';
		$role->description = 'Delete others campaigns';
		$role->save();

		$role = new Role();
		$role->name = 'view_articles';
		$role->description = 'View articles';
		$role->save();

		$role = new Role();
		$role->name = 'view_settings';
		$role->description = 'Can view settings';
		$role->save();

		$role = new Role();
		$role->name = 'edit_settings';
		$role->description = 'Can edit settings';
		$role->save();

		$role = new Role();
		$role->name = 'create_setting';
		$role->description = 'Create a setting';
		$role->save();

		$role = new Role();
		$role->name = 'view_staff';
		$role->description = 'View Staff';
		$role->save();

		$role = new Role();
		$role->name = 'create_staff';
		$role->description = 'Create staff member';
		$role->save();

		$role = new Role();
		$role->name = 'edit_staff';
		$role->description = 'Edit their account';
		$role->save();

		$role = new Role();
		$role->name = 'edit_other_staff';
		$role->description = 'Edit other staff';
		$role->save();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
