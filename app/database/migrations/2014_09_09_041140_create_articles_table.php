<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function($table)
		{
			$table->increments('id');
			$table->softDeletes();
			$table->timestamps();

			$table->dateTime('published_at');

			$table->text('title');
			$table->text('link');

			$table->text('author');
			$table->text('category');
			$table->text('description');
		});

		Schema::table('posts', function($table){
			$table->integer('article_id')->unsigned();
			$table->foreign('article_id')->references('id')->on('articles');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('articles');

		Schema::table('posts', function($table)
		{
			$table->dropColumn('article_id');
		});
	}

}
