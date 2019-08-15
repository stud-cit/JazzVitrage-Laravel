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
            'group_people_id' => 1,
            'application_id' => 1,
            'name' => 'Океан Ельзи',
            'count_people' => 5,
            'average_age' => 37,
            'file' => 0,
        ]);

    }
}
