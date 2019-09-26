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
            'nomination_id' => 1,
            'application_type_id' => 1,
            'status' => 'created',
        ]);
        DB::table('application')->insert([
            'nomination_id' => 2,
            'application_type_id' => 2,
            'status' => 'created',
        ]);
        DB::table('application')->insert([
            'nomination_id' => 3,
            'application_type_id' => 4,
            'status' => 'created',
        ]);
        DB::table('application')->insert([
            'nomination_id' => 1,
            'application_type_id' => 5,
            'status' => 'created',
        ]);
        DB::table('application')->insert([
            'nomination_id' => 3,
            'application_type_id' => 5,
            'status' => 'created',
        ]);
        DB::table('application')->insert([
            'nomination_id' => 3,
            'application_type_id' => 3,
            'status' => 'created',
        ]);
        DB::table('application')->insert([
            'nomination_id' => 3,
            'application_type_id' => 3,
            'status' => 'created',
        ]);
    }
}
