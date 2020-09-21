<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArtistMusic extends Migration
{
    public function up()
	{
		Schema::create('artist_music', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('artist_id');
            $table->unsignedInteger('music_id');
            $table->foreign('artist_id')->references('id')->on('artists');
			$table->foreign('music_id')->references('id')->on('music');
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
		Schema::drop('artist_music');
	}
}
