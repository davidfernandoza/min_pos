<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Models\Product;
use App\Models\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {

	return [
		'url' => $faker->imageUrl($width = 500, $height = 200),
		'imageable_type' => 'App\Models\Product',
		//'imageable_id' => Product::inRandomOrder()->value('id') ?: factory(Product::class),
		'imageable_id' => $faker->unique()->numberBetween($min = 1, $max = 80),
		'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
		'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
		//
	];
});
