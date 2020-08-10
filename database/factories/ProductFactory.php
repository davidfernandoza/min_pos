<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
			'category_id' => rand(1, 4),
			'amount' => $faker->randomNumber($nbDigits = NULL, $strict = false),
			'price' => $faker->randomFloat($nbMaxDecimals = 5, $min = 10000.00000, $max = 1000000.00000),
			'description' => $faker->text($maxNbChars = 200),
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
		];
});
