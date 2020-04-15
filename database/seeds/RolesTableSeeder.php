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
        $superAdminRole = Role::create(['name' => 'super admin', 'label' => 'Super Administrator'])->allowTo(Ability::all());
        $userRole       = Role::create(['name' => 'user', 'label' => 'User']);

        $authorRole = Role::create(['name' => 'author', 'label' => 'Author']);
        $authorRole->allowTo('browse-posts');
        $authorRole->allowTo('read-posts');
        $authorRole->allowTo('edit-posts');
        $authorRole->allowTo('add-posts');
        $authorRole->allowTo('destroy-posts');
        
        $editorRole = Role::create(['name' => 'editor', 'label' => 'Editor']);
        $editorRole->allowTo('browse-posts');
        $editorRole->allowTo('read-posts');
        $editorRole->allowTo('edit-posts');
        $editorRole->allowTo('add-posts');
        $editorRole->allowTo('destroy-posts');
        $editorRole->allowTo('browse-categories');
        $editorRole->allowTo('read-categories');
        $editorRole->allowTo('edit-categories');
        $editorRole->allowTo('add-categories');
        $editorRole->allowTo('destroy-categories');
    }
}
