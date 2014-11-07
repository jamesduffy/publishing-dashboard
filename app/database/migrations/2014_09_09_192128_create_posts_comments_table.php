<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts_comments', function($table)
		{
		    $table->increments('id');
		    $table->softDeletes();
		    $table->timestamps();

		    $table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');

			$table->integer('post_id')->unsigned();
			$table->foreign('post_id')->references('id')->on('posts');

		    $table->text('text');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('posts_comments');
	}

}
