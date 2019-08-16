<?php

use Illuminate\Database\Seeder;

class ApplicationTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('application_type')->insert([
            'application_type_id' => 1,
            'name' => 'ансамбль',
        ]);
        DB::table('application_type')->insert([
            'application_type_id' => 2,
            'name' => 'дует',
        ]);
        DB::table('application_type')->insert([
            'application_type_id' => 3,
            'name' => 'соліст',
        ]);
    }
}
