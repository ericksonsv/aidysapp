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

        // Permissions
        Ability::create(['name' => 'browse-abilities', 	'label' => 'Browse Abilities']);
        Ability::create(['name' => 'read-abilities', 	'label' => 'Read Abilities']);
        Ability::create(['name' => 'edit-abilities', 	'label' => 'Edit Abilities']);
        Ability::create(['name' => 'add-abilities', 	'label' => 'Add Abilities']);
        Ability::create(['name' => 'destroy-abilities', 'label' => 'Destroy Abilities']);
    }
}
