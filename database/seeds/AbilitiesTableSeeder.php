<?php

use App\Ability;
use Illuminate\Database\Seeder;

class AbilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Users
        Ability::create(['name' => 'browse-users', 	'label' => 'Browse Users']);
        Ability::create(['name' => 'read-users', 	'label' => 'Read Users']);
        Ability::create(['name' => 'edit-users', 	'label' => 'Edit Users']);
        Ability::create(['name' => 'add-users', 	'label' => 'Add Users']);
        Ability::create(['name' => 'destroy-users', 'label' => 'Destroy Users']);

        // Roles
        Ability::create(['name' => 'browse-roles', 	'label' => 'Browse Roles']);
        Ability::create(['name' => 'read-roles', 	'label' => 'Read Roles']);
        Ability::create(['name' => 'edit-roles', 	'label' => 'Edit Roles']);
        Ability::create(['name' => 'add-roles', 	'label' => 'Add Roles']);
        Ability::create(['name' => 'destroy-roles', 'label' => 'Destroy Roles']);

        // Abilities
        Ability::create(['name' => 'browse-abilities', 	'label' => 'Browse Abilities']);
        Ability::create(['name' => 'read-abilities', 	'label' => 'Read Abilities']);
        Ability::create(['name' => 'edit-abilities', 	'label' => 'Edit Abilities']);
        Ability::create(['name' => 'add-abilities', 	'label' => 'Add Abilities']);
        Ability::create(['name' => 'destroy-abilities', 'label' => 'Destroy Abilities']);

        // Categories
        Ability::create(['name' => 'browse-categories',  'label' => 'Browse Categories']);
        Ability::create(['name' => 'read-categories',    'label' => 'Read Categories']);
        Ability::create(['name' => 'edit-categories',    'label' => 'Edit Categories']);
        Ability::create(['name' => 'add-categories',     'label' => 'Add Categories']);
        Ability::create(['name' => 'destroy-categories', 'label' => 'Destroy Categories']);

        // Posts
        Ability::create(['name' => 'browse-posts',  'label' => 'Browse Posts']);
        Ability::create(['name' => 'read-posts',    'label' => 'Read Posts']);
        Ability::create(['name' => 'edit-posts',    'label' => 'Edit Posts']);
        Ability::create(['name' => 'add-posts',     'label' => 'Add Posts']);
        Ability::create(['name' => 'destroy-posts', 'label' => 'Destroy Posts']);

        // Comments
        Ability::create(['name' => 'browse-comments',  'label' => 'Browse Comments']);
        Ability::create(['name' => 'read-comments',    'label' => 'Read Comments']);
        Ability::create(['name' => 'edit-comments',    'label' => 'Edit Comments']);
        Ability::create(['name' => 'add-comments',     'label' => 'Add Comments']);
        Ability::create(['name' => 'destroy-comments', 'label' => 'Destroy Comments']);

        // Tags
        Ability::create(['name' => 'browse-tags',  'label' => 'Browse Tags']);
        Ability::create(['name' => 'read-tags',    'label' => 'Read Tags']);
        Ability::create(['name' => 'edit-tags',    'label' => 'Edit Tags']);
        Ability::create(['name' => 'add-tags',     'label' => 'Add Tags']);
        Ability::create(['name' => 'destroy-tags', 'label' => 'Destroy Tags']);
    }
}
