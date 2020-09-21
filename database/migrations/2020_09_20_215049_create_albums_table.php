<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAlbumsTable.
 */
class CreateAlbumsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('albums', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name',45);
			$table->string('description', 100);
			$table->binary('cover');
			$table->integer('numberOfTracks');
			$table->string('gender', 25);
			$table->date('releaseDate');
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('albums');
	}
}
