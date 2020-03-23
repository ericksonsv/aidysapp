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
        $user = User::create([
        	'role_id' => Role::find(1)->id,
        	'name' => 'Erickson Suero',
        	'email' => 'ericksuero@gmail.com',
        	'password' => bcrypt('shinobi')
        ]);
    }
}
