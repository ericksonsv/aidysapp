<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Category::class, function (Faker $faker) {
	$name = $faker->unique()->sentence(2);
    return [
        'name' => Str::title($name),
        'slug' => Str::slug($name),
        'description' => $faker->sentence
    ];
});
