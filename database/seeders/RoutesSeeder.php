<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class RoutesSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('routes')->insert([
				'route_name'  => 'users_manage',
				'route_title' => 'Quản lý user'
			]);
		DB::table('routes')->insert([
				'route_name'  => 'edit_user',
				'route_title' => 'Sửa thông tin user'
			]);
		DB::table('routes')->insert([
				'route_name'  => 'post_manage',
				'route_title' => 'Quản lý bài viết'
			]);
		DB::table('routes')->insert([
				'route_name'  => 'user_index',
				'route_title' => 'View User'
			]);
		DB::table('routes')->insert([
				'route_name'  => 'post_index',
				'route_title' => 'View bài viết'
			]);
	}
}