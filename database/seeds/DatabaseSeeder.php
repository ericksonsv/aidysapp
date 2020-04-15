<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AbilitiesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);

        factory(App\User::class, 17)->create();
        factory(App\Category::class, 9)->create();
        factory(App\Tag::class, 20)->create();

        factory(App\Post::class, 100)->create()->each(function ($post) {
            $post->tags()->attach($this->array(rand(1,20)));

            $number_comments = rand(1,50);
            for ($i=1; $i < $number_comments; $i++) { 
                $post->comments()->save(
                    factory(App\Comment::class)->make()
                );
            }
        });
    }

    public function array($max)
    {
        $values = [];
        for ($i=1; $i < $max; $i++) { 
            $values[] = $i;
        }
        return $values;
    }
}
