<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_superAdmin = Role::where('name', 'superAdmin')->first();

        $boss = new User();
        $boss->name = 'Logan';
        $boss->email = 'steevo@gmail.com';
        $boss->password = bcrypt('7777777');
        $boss->firstname = 'Steevo';
        $boss->birthday = '1984-01-31';
        $boss->save();
        $boss->roles()->attach($role_superAdmin);
    }
}
