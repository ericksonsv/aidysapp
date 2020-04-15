<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::create([
        	'role_id' => Role::find(1)->id,
        	'name' => 'Erickson Suero',
        	'email' => 'ericksuero@gmail.com',
        	'password' => bcrypt('shinobi')
        ]);
        $user = User::create([
            'role_id' => Role::find(2)->id,
            'name' => 'Marleny Paredes',
            'email' => 'marlenyparedess@gmail.com',
            'password' => bcrypt('password')
        ]);
        $author = User::create([
            'role_id' => Role::find(3)->id,
            'name' => 'Aidys Marie Suero Paredes',
            'email' => 'aidysmariesp@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}
