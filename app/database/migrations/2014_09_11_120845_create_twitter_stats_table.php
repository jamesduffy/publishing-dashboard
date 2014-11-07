<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwitterStatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('twitter_stats', function($table){
			$table->bigInteger('id')->index();
			$table->timestamps();

			$table->datetime('twitter_created_at');

			$table->string('text');
			$table->string('source');

			$table->integer('retweet_count');
			$table->integer('favorite_count');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('twitter_stats');
	}

}
