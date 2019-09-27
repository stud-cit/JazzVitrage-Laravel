<?php

use Illuminate\Database\Seeder;

class GroupPeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group_people')->insert([
            'application_id' => 3,
            'name' => 'Океан Ельзи',
            'count_people' => 5,
            'average_age' => 37,
            'file' => 0,
        ]);
        DB::table('group_people')->insert([
            'application_id' => 4,
            'name' => 'Bon Jovi',
            'count_people' => 5,
            'average_age' => 37,
            'file' => 0,
        ]);
        DB::table('group_people')->insert([
            'application_id' => 5,
            'name' => 'Five Finger Death Punch',
            'count_people' => 5,
            'average_age' => 37,
            'file' => 0,
        ]);
        DB::table('group_people')->insert([
            'application_id' => 6,
            'name' => '3 Doors Down',
            'count_people' => 5,
            'average_age' => 37,
            'file' => 0,
        ]);
        DB::table('group_people')->insert([
            'application_id' => 7,
            'name' => 'Daughtry',
            'count_people' => 5,
            'average_age' => 37,
            'file' => 0,
        ]);
    }
}
