<?php

use Illuminate\Database\Seeder;

class UsersMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_messages')->insert([
            'type' => 'application_accepted',
            'text' => 'Ваша заявка на участь в конкурсі JazzVitrage прийнята.'
        ]);
        DB::table('users_messages')->insert([
            'type' => 'application_approved',
            'text' => 'Вашу заявку на участь в конкурсі JazzVitrage затверджено.'
        ]);
        DB::table('users_messages')->insert([
            'type' => 'application_denied',
            'text' => 'Вашу заявку на участь в конкурсі JazzVitrage відхилено.'
        ]);
        DB::table('users_messages')->insert([
            'type' => 'jury_accepted',
            'text' => 'Вас зареєстровано в якості журі в конкурсі JazzVitrage. Сайт конкрсу http://fest.jazz.sumy.ua. Перейдіть за наступним посиланням http://fest.jazz.sumy.ua/login і введіть логін і пароль що написано нижче в тескті повідомлення.'
        ]);
        DB::table('users_messages')->insert([
            'type' => 'org_accepted',
            'text' => 'Вас зареєстровано в якості організаійного комітету в конкурсі JazzVitrage. Сайт конкрсу http://fest.jazz.sumy.ua. Перейдіть за наступним посиланням http://fest.jazz.sumy.ua/login і введіть логін і пароль що написано нижче в тескті повідомлення.'
        ]);
        DB::table('users_messages')->insert([
            'type' => 'admin_accepted',
            'text' => 'Вас зареєстровано в якості адміністратора на сайті http://fest.jazz.sumy.ua. Перейдіть за наступним посиланням http://fest.jazz.sumy.ua/login і введіть логін і пароль що написано нижче в тескті повідомлення.'
        ]);
        DB::table('users_messages')->insert([
            'type' => 'invitation',
            'text' => 'Запрошуємо Вас на Гала-Концерт JazzVitrage.'
        ]);
    }
}
