<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FunctionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('function')->insert([
            'id_application' => 1,
            'code' => 'LNG00001',
            'name' => 'Login',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
