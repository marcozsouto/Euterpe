<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMusicTable.
 */
class CreateMusicTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('music', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name',254);
			$table->time('time');
			$table->binary('music');
			$table->string('description', 100);
			$table->integer('trackNumber');
			$table->bigInteger('streams');
			$table->foreign('album_id')->references('id')->on('albums');
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
		Schema::drop('music');
	}
}
