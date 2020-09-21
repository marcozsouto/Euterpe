<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlbumUser extends Migration
{
    public function up()
	{
		Schema::create('album_user', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('album_id');
            $table->foreign('user_id')->references('id')->on('users');
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
		Schema::drop('album_user');
	}
}