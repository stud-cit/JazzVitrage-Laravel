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
            'solo_id' => 1,
            'name' => 'Им’я сольного учасника',
            'surname' => 'Прізвище сольного учасника',
            'patronomic' => 'По батькові сольного учасника',
            'data_birthday' => '15.08.2019',
            'email' => 'hansolo@email.com',
            'passport_photo' => 'passport-photo.png',
            'in' => '547435445',
            'parent_name' => 'Ім’я батьків учасника',
            'parent_surname' => 'Прізвище батьків учасника',
            'parent_patronomic' => 'По батькові батьків учасника',
            'is_duet' => 0,
            'application_id' => 3,
        ]);
    }
}
