<?php

use Illuminate\Database\Seeder;

class SoloDuetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('solo_duet')->insert([
            'name' => 'Василий',
            'surname' => 'Ситников',
            'patronomic' => 'Константинович',
            'memberEmail' => 'member@gmail.com',
            'data_birthday' => '2019-08-16',
            'passport_photo' => 'passport-photo.png',
            'in' => '547435445',
            'in_file' => 'in.jpg',
            'parent_name' => 'Констант',
            'parent_surname' => 'Ситников',
            'parent_patronomic' => 'Егорович',
            'is_duet' => 0,
            'application_id' => 1,
        ]);
        DB::table('solo_duet')->insert([
            'name' => 'Валентин',
            'surname' => 'Шубин',
            'patronomic' => 'Петрович',
            'memberEmail' => 'member@gmail.com',
            'data_birthday' => '2019-08-16',
            'passport_photo' => 'passport-photo.png',
            'in' => '547435445',
            'in_file' => 'in.jpg',
            'parent_name' => 'Петро',
            'parent_surname' => 'Шубин',
            'parent_patronomic' => 'Семёнович',
            'is_duet' => 1,
            'application_id' => 2,
        ]);
        DB::table('solo_duet')->insert([
            'name' => 'Нинна',
            'surname' => 'Баранова',
            'patronomic' => 'Петровна',
            'memberEmail' => 'member@gmail.com',
            'data_birthday' => '2019-08-16',
            'passport_photo' => 'passport-photo.png',
            'in' => '547435445',
            'in_file' => 'in.jpg',
            'parent_name' => 'Петро',
            'parent_surname' => 'Баранов',
            'parent_patronomic' => 'Семёнович',
            'is_duet' => 1,
            'application_id' => 2,
        ]);
    }
}
