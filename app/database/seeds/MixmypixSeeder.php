<?php

class MixmypixSeeder extends  Seeder {
	public function run() {
				# Clear the tables to a blank slate
		DB::statement('SET FOREIGN_KEY_CHECKS=0'); # Disable FK constraints so that all rows can be deleted, even if there's an associated FK
		DB::statement('TRUNCATE mingles');
		DB::statement('TRUNCATE pictures');
		DB::statement('TRUNCATE templates');
		DB::statement('TRUNCATE users');

		# Users (first)
		$user = new User;
		$user->email = 'cesarzavalamesta@g.harvard.edu';
		$user->password = Hash::make('susanbuck');
		$user->save();		

		$user_id = $user->id;

		# Templates
		$summerschool = new Template();
		$summerschool->user_id = $user_id;
		$summerschool->name = 'Harvard Summer School';
		$summerschool->path = '../templates/SummerSchool.png';
		$summerschool->public = true;
		$summerschool->dst_x = 1;
		$summerschool->dst_y = 1;
		$summerschool->dst_h = 1;
		$summerschool->dst_w = 1;
		$summerschool->image = $summerschool->path;
		$summerschool->save();

		$veritas2 = new Template();
		$veritas2->user_id = $user_id;
		$veritas2->name = 'Harvard Veritas';
		$veritas2->path = '../templates/2Veritas.png';
		$veritas2->public = true;
		$veritas2->dst_x = 1;
		$veritas2->dst_y = 1;
		$veritas2->dst_h = 1;
		$veritas2->dst_w = 1;
		$veritas2->image = $veritas2->path;
		$veritas2->save();

		$harvard8 = new Template();
		$harvard8->user_id = $user_id;
		$harvard8->name = 'Harvard Logo 8';
		$harvard8->path = '../templates/Harvard8.png';
		$harvard8->public = true;
		$harvard8->dst_x = 1;
		$harvard8->dst_y = 1;
		$harvard8->dst_h = 1;
		$harvard8->dst_w = 1;
		$harvard8->image = $harvard8->path;
		$harvard8->save();		

		$wwc = new Template();
		$wwc->user_id = $user_id;
		$wwc->name = 'Woman Who Code Boston 2014';
		$wwc->path = '../templates/WWCBoston2014.png';
		$wwc->public = true;
		$wwc->dst_x = 1;
		$wwc->dst_y = 1;
		$wwc->dst_h = 1;
		$wwc->dst_w = 1;
		$wwc->image = $wwc->path;
		$wwc->save();	

	}
}


?>