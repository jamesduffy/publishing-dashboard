<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('posts', function($table)
		{
			$table->string('year', 4);
			$table->string('month', 2);
			$table->string('day', 2);
			$table->string('hour', 2);
			$table->string('minute', 2);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('posts', function($table)
		{
			$table->dropColumn('year');
			$table->dropColumn('month');
			$table->dropColumn('day');
			$table->dropColumn('hour');
			$table->dropColumn('minute');
		});
	}

}
