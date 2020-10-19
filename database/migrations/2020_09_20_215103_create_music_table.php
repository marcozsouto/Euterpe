<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
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
			$table->string('name',256);
			$table->time('time');
			$table->string('music');
			$table->string('description', 256)->nullable();
			$table->integer('trackNumber');
			$table->bigInteger('streams');
			$table->unsignedInteger('album_id');
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
