<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('periods')->insert([
            'start_date' => today(),
            'expiration_date' => today(),
            'status' => false 
        ]);
    }
}
