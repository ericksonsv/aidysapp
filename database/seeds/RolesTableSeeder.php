<?php

use App\Ability;
use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'super admin','label' => 'Super Administrator'])->allowTo(Ability::all());
        Role::create(['name' => 'user','label' => 'User']);
    }
}
