<?php

use Illuminate\Database\Seeder;

class ApplicationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('application')->insert([
            'application_id' => 1,
            'nomination_id' => 1,
            'application_type_id' => 1,
            'status' => '',
        ]);
        DB::table('application')->insert([
            'application_id' => 2,
            'nomination_id' => 2,
            'application_type_id' => 2,
            'status' => '',
        ]);
        DB::table('application')->insert([
            'application_id' => 3,
            'nomination_id' => 3,
            'application_type_id' => 3,
            'status' => '',
        ]);
    }
}
