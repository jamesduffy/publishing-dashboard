<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwitterFollowersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('twitter_profile_stats', function($table){
		    $table->increments('id');
			$table->timestamps();

			$table->integer('followers');
			$table->integer('following');
			$table->integer('listed');
			$table->integer('friends');
			$table->integer('statuses');
			$table->integer('favorites');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('twitter_profile_stats');
	}

}
