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
            'patronymic' => 'Константинович',
            'member_email' => 'member@gmail.com',
            'member_address' => 'м. Суми, пр. Лушпи, 7, кв. 71',
            'data_birthday' => '2002-08-16',
            'passport_data' => 'МВ 276551',
            'passport_photo' => 'passport-photo.png',
            'in' => '547435445',
            'in_file' => 'in.jpg',
            'parent_name' => 'Констант',
            'parent_surname' => 'Ситников',
            'parent_patronymic' => 'Егорович',
            'is_duet' => 0,
            'application_id' => 1,
        ]);
        DB::table('solo_duet')->insert([
            'name' => 'Валентин',
            'surname' => 'Шубин',
            'patronymic' => 'Петрович',
            'member_email' => 'member@gmail.com',
            'member_address' => 'м. Суми, вул. Миру, 5, кв. 36',
            'data_birthday' => '2001-08-16',
            'passport_data' => 'МВ 394451 видано Зарічним РВ УДМС України в Сумській області 12.02.2013',
            'passport_photo' => 'passport-photo.png',
            'in' => '547435445',
            'in_file' => 'in.jpg',
            'parent_name' => 'Петро',
            'parent_surname' => 'Шубин',
            'parent_patronymic' => 'Семёнович',
            'is_duet' => 1,
            'application_id' => 2,
        ]);
        DB::table('solo_duet')->insert([
            'name' => 'Нина',
            'surname' => 'Баранова',
            'patronymic' => 'Петровна',
            'member_email' => 'member@gmail.com',
            'member_address' => 'м. Суми, вул. Герасима Кондратьєва, 23, кв. 11',
            'data_birthday' => '2011-08-16',
            'passport_data' => 'МВ 724459 видано Зарічним РВ УДМС України в Сумській області 12.02.2013',
            'passport_photo' => 'passport-photo.png',
            'in' => '547435445',
            'in_file' => 'in.jpg',
            'parent_name' => 'Петро',
            'parent_surname' => 'Баранов',
            'parent_patronymic' => 'Семёнович',
            'is_duet' => 1,
            'application_id' => 2,
        ]);
    }
}
