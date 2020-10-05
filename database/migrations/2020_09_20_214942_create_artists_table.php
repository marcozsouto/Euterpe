<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
/**
 * Class CreateArtistsTable.
 */
class CreateArtistsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('artists', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name',45);
			$table->string('description', 256)->nullable();
			$table->string('musicGender', 25);
			$table->binary('icon');
			$table->binary('cover');
			$table->integer('followers');
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
		Schema::drop('artists');
	}
}
