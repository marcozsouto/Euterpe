<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable.
 */
class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
			$table->string('cpf', 11)->unique();
			$table->string('name',50);
			$table->string('username', 45)->unique();
			$table->string('email',254)->unique();
			$table->string('password',254);
			$table->char('gender',1);
			$table->date('birth');
			$table->binary('icon');
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
		Schema::drop('users');
	}
}
