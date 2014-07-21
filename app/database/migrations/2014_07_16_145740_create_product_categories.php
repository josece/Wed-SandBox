<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('taxonomies', function($table){
			$table->increments('id');
			$table->string('name');
			$table->text('description');
			$table->string('permalink');
			$table->integer('count');
			$table->string('type');
			$table->timestamps();
			$table->integer('parent_id')->unsigned()->default(0);
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
		Schema::drop('taxonomies');
	}

}
