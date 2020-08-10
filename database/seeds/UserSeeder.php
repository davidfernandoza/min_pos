<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

			DB::table('users')->insert([
				'names' => 'David Fernando',
				'last_names' => 'Torres Zapata',
				'email' => 'fernando.zapata.live@gmail.com',
				'password' =>  Hash::make('123456789'),
				'rol' => 'ADMIN',
				'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
				'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
			]);
    }
}
