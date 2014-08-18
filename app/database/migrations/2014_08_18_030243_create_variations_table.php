<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		//
		Schema::create('products_variations', function($table) {
	         $table->increments('id');
	         $table->unsignedInteger('product_id');
	         $table->string('name');
	         $table->decimal('price', 5, 2);
	         $table->timestamps();
	         $table->foreign('product_id')->references('id')->on('products');
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
		Schema::drop('products_variations');
	}

}
