<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function($table)
		{
		    $table->increments('id');
		    $table->softDeletes();
		    $table->timestamps();

		    $table->enum('network', array('facebook', 'twitter'));
		    $table->enum('status', array('draft', 'pending', 'approved', 'scheduled', 'published'));

		    $table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');

			$table->datetime('scheduled_at');
			$table->datetime('publish_at');

		    $table->text('text');
		    $table->text('link');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('posts');
	}

}
