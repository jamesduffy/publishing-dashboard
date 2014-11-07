<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
		{
		    $table->increments('id');
		    $table->softDeletes();
		    $table->timestamps();

		    $table->enum('role', array('admin', 'editor', 'writer'));

		    $table->string('email');
		    $table->string('username')->index();
		    $table->string('password');
		    $table->string('first_name');
		    $table->string('last_name');

		    $table->rememberToken();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}

}
