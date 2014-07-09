<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('products', function($table) {
	         $table->increments('id');
	         $table->unsignedInteger('store_id');
	         $table->string('name');
	         $table->string('permalink')->unique();
	         $table->string('image');
	         $table->decimal('price', 5, 2);
	         $table->text('description');
	          $table->timestamps();
	         $table->foreign('store_id')->references('id')->on('stores');
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
		Schema::drop('products');
	}

}
