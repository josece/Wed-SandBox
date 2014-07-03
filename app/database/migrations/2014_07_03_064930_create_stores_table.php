<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('stores', function($table) {
	         $table->increments('id');
	         $table->unsignedInteger('user_id');
	         $table->string('name');
	         $table->string('permalink')->unique();
	         $table->string('logo');
	         $table->string('cover');
	         $table->text('description');
	         $table->foreign('user_id')->references('id')->on('users');
	     });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('stores');
	}

}
