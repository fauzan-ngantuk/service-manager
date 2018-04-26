<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AplicationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('application')->insert([
            'name' => 'Learning UIN Suka',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
