<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
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
			$table->string('name',100);
			$table->string('description', 256)->nullable();
			$table->string('icon');
			$table->integer('numberOfTracks');
			$table->string('gender', 25);
			$table->date('releaseDate');
			$table->unsignedInteger('artist_id');
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
		Schema::drop('albums');
	}
}
