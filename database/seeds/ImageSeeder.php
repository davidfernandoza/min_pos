<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
			DB::table('images')->insert([
				'url' => 'images/default.png',
				'imageable_type' => 'App\Models\User',
				'imageable_id' => 1,
				'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
				'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
			]);

			factory(App\Models\Image::class, 80)->create();
    }
}
