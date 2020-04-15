<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
	$title = $faker->unique()->sentence;
    return [
        'user_id' => rand(1,20),
        'category_id' => rand(1,10),
        'title' => $title,
        'seo_title' => $faker->sentence,
        'slug' => Str::slug($title),
        'excerpt' => $faker->paragraph,
        'body' => $faker->paragraph,
        'image_url' => $faker->url,
        'video_url' => $faker->url,
        'meta_description' => $faker->text,
        'meta_keywords' => $faker->sentence,
        'status' => $faker->randomElement(['PUBLISHED','PENDING','DRAFT']),
        'featured' => rand(0,1),
        'views' => rand(0,100),
    ];
});
