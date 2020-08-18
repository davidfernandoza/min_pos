<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	* Seed the application's database.
	*
	* @return void
	*/
	public function run()
	{
		$this->truncateTables([
			'images',
			'products',
			'categories',
			'users',
			'roles',
			'model_has_roles'
			]);

		$this->call('CategorySeeder');
		$this->call('ProductSeeder');
		$this->call('UserSeeder');
		$this->call('ImageSeeder');
		$this->call('RoleSeeder');
		$this->call('ModelHasRoleSeeder');
	}

	protected function truncateTables(array $tables){
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		foreach ($tables as $table) {
			DB::table($table)->truncate();
		}
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
	}
}
