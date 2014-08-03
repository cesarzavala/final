<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('users',function($table){
			$table->increments('user_id');
			$table->string('email')->unique();
			$table->boolean('remember_token');
			$table->string('password');
			$table->timestamps();
		});

		Schema::create('templates',function($table){
			$table->increments('template_id');
			$table->integer('user_id')->unsigned();
			$table->string('name');
			$table->string('path');
			$table->boolean('public');
			$table->integer('dst_x');
			$table->integer('dst_y');
			$table->integer('dst_w');
			$table->integer('dst_h');
			$table->binary('image');
			$table->timestamps();

			#FK
			$table->foreign('user_id')->references('user_id')->on('users');

		});

		Schema::create('pictures',function($table){
			$table->increments('picture_id');
			$table->integer('user_id')->unsigned();
			$table->string('name');
			$table->string('path');
			$table->boolean('public');
			$table->integer('src_x');
			$table->integer('src_y');
			$table->integer('src_w');
			$table->integer('src_h');
			$table->binary('image');
			$table->timestamps();

			#FK
			$table->foreign('user_id')->references('user_id')->on('users');
		});


		Schema::create('mingles', function($table){
			$table->increments('mingle_id');
			$table->integer('user_id')->unsigned();
			$table->integer('template_id')->unsigned();
			$table->integer('picture_id')->unsigned();
			$table->string('path');
			$table->binary('image');
			$table->timestamps();

			#FK
			$table->foreign('user_id')->references('user_id')->on('users');
			$table->foreign('template_id')->references('user_id')->on('templates');
			$table->foreign('picture_id')->references('user_id')->on('pictures');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	
		Schema::table('mingles', function($table) {
			$table->dropForeign('mingles_picture_id_foreign'); # table_fields_foreign
			$table->dropForeign('mingles_template_id_foreign'); # table_fields_foreign
			$table->dropForeign('mingles_user_id_foreign'); # table_fields_foreign
		});

		Schema::table('pictures', function($table) {
			$table->dropForeign('pictures_user_id_foreign'); # table_fields_foreign
		});

		Schema::table('templates', function($table) {
			$table->dropForeign('templates_user_id_foreign'); # table_fields_foreign
		});

		//
		Schema::drop('mingles');
		Schema::drop('templates');
		Schema::drop('pictures');
		Schema::drop('users');
	
	}

}
