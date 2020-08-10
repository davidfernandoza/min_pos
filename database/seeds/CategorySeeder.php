<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('categories')->insert([
				'name' => 'Cocina',
				'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
				'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
			]);

			DB::table('categories')->insert([
				'name' => 'Informatica',
				'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
				'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
			]);

			DB::table('categories')->insert([
				'name' => 'Mascotas',
				'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
				'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
			]);

			DB::table('categories')->insert([
				'name' => 'Deportes',
				'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
				'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
			]);
    }
}
