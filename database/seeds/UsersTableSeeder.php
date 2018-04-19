<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => bcrypt('service-manager-admin'),
            'secret' => str_random(10),
            'role' => 'admin',
            'application_grant' => 'all'
        ]);
    }
}
