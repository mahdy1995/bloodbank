<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCityClientTable extends Migration {

	public function up()
	{
		Schema::create('city_client', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('city_id')->unsigned();
			$table->integer('client_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('city_client');
	}
}