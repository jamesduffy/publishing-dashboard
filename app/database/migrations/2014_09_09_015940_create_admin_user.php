<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$user = new User;

		$user->email 		= 'me@your-website.com';
		$user->username 	= 'admin';
		$user->password 	= Hash::make('password');
		$user->first_name 	= 'Signal';
		$user->last_name 	= 'Admin';
		$user->role 		= 'admin';

		$user->save();
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
