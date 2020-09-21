<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlbumArtist extends Migration
{
    public function up()
	{
		Schema::create('album_artist', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('artist_id');
            $table->unsignedInteger('album_id');
            $table->foreign('artist_id')->references('id')->on('artists');
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
		Schema::drop('album_artist');
	}
}