<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArtistUser extends Migration
{
    public function up()
	{
		Schema::create('artist_user', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('artist_id');
            $table->foreign('user_id')->references('id')->on('users');
			$table->foreign('artist_id')->references('id')->on('artists');
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
		Schema::drop('artist_user');
	}
}
