<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * Basic role, read, buy and comment publication
         */
        $role = new Role();
        $role->name = 'writer';
        $role->save();

        /**
         * Subscriber role, 19,00 €, full access
         */
        $role = new Role();
        $role->name = 'subscriber';
        $role->save();

        /**
         * Publication, comments mannager
         */
        $role = new Role();
        $role->name = 'admin';
        $role->save();

        /**
         * Bought mannager
         */
        $role = new Role();
        $role->name = 'adminAccounting';
        $role->save();

        /**
         * Pictures, pub mannager
         */
        $role = new Role();
        $role->name = 'adminMarketing';
        $role->save();

        /**
         * Role mannager and all rights
         */
        $role = new Role();
        $role->name = 'superAdmin';
        $role->save();
    }
}
