<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tag;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Tag::class, function (Faker $faker) {
	$name = $faker->unique()->word;
    return [
        'name' => Str::title($name),
        'slug' => Str::slug($name),
    ];
});
