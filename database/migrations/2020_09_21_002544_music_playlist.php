<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MusicPlaylist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_playlist', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('playlist_id');
            $table->unsignedInteger('music_id');
            $table->foreign('playlist_id')->references('id')->on('playlists');
			$table->foreign('music_id')->references('id')->on('musics');
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
        Schema::drop('music_playlist');
    }
}
