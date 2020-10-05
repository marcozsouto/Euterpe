<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
/**
 * Class CreatePlaylistsTable.
 */
class CreatePlaylistsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('playlists', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name',256);
			$table->string('description', 256);
			$table->binary('icon');
			$table->integer('view');
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');
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
		Schema::drop('playlists');
	}
}
