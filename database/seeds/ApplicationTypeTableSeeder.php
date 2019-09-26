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
            'name' => 'соліст',
        ]);
        DB::table('application_type')->insert([
            'name' => 'дует',
        ]);
        DB::table('application_type')->insert([
            'name' => 'ансамбль',
        ]);
        DB::table('application_type')->insert([
            'name' => 'Хор',
        ]);
        DB::table('application_type')->insert([
            'name' => 'Оркестр',
        ]);
    }
}
