<?php
use Illuminate\Database\Seeder;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role' => 'jury',
            'email' => 'jury@gmail.com',
            'password' => Hash::make('password'),
            'name' => 'Инга',
            'surname' => 'Щербакова',
            'patronymic' => 'Степановна',
            'photo' => 'testUserFoto.jpg',
            'rank' => 'Звання',
            'nominations' => 'Інструментальний жанр',
            'informations' => 'Way own uncommonly travelling now acceptance bed compliment solicitude'
        ]);
        DB::table('users')->insert([
            'role' => 'orgComittee',
            'email' => 'org@gmail.com',
            'password' => Hash::make('password'),
            'name' => 'Людмила',
            'surname' => 'Грабарь',
            'patronymic' => 'Тихоновна',
            'photo' => 'testUserFoto.jpg',
            'informations' => 'Estate was tended ten boy nearer seemed. Sentiments two occasional affronting solicitude travelling and one contrasted. Ecstatic elegance gay but disposed. You high bed wish help call draw side. You high bed wish help call draw side. Uncommonly no it announcing melancholy an in. Bed uncommonly his discovered for estimating far'
        ]);
        DB::table('users')->insert([
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'name' => 'Петров',
            'surname' => 'Несторович'
        ]);
        DB::table('users')->insert([
            'role' => 'superAdmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password'),
            'name' => 'Андрей',
            'surname' => 'Новичков'
        ]);
    }
}