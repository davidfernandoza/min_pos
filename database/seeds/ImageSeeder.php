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
				'url' => $faker->imageUrl($width = 200, $height = 200),
				'imageable_type' => 'App\Models\User',
				'imageable_id' => 1,
				'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
				'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
			]);

			factory(App\Models\Image::class, 10)->create();
    }
}
