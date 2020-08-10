<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
	return [
		'url' => $faker->imageUrl($width = 500, $height = 200),
		'imageable_type' => 'App\Models\Product',
		'imageable_id' => rand(1, 10),
		'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
		'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
		//
	];
});
