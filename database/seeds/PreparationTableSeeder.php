<?php
use Illuminate\Database\Seeder;
class PreparationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('preparation')->insert([
            'school_one' => 'Сумська Музична школа 1',
            'school_address' => 'м.Суми, вул.Засумська 1',
            'school_email' => 'email@school.lol1',
            'school_phone' => '+380502864031',
            'teacher_name' => 'Иван 1',
            'teacher_surname' => 'Иванов 1',
            'teacher_patronomic' => 'Иванович',
            'teacher_in' => '880055535351',
            'teacher_email' => 'teacher@email.com1',
            'teacher_phone' => '+380502864031',
            'is_concertmaster' => 1,
            'concertmaster_name' => 'Виктор',
            'concertmaster_surname' => 'Федорович',
            'concertmaster_patronomic' => 'Концертмейстерович',
            'application_id' => 1,
        ]);
        DB::table('preparation')->insert([
            'school_one' => 'Сумська Музична школа 2',
            'school_address' => 'м.Суми, вул.Засумська 2',
            'school_email' => 'email@school.lol2',
            'school_phone' => '+380502864032',
            'teacher_name' => 'Иван 2',
            'teacher_surname' => 'Иванов 2',
            'teacher_patronomic' => 'Иванович',
            'teacher_in' => '880055535352',
            'teacher_email' => 'teacher@email.com2',
            'teacher_phone' => '+380502864031',
            'is_concertmaster' => 1,
            'concertmaster_name' => 'Виктор',
            'concertmaster_surname' => 'Федорович',
            'concertmaster_patronomic' => 'Концертмейстерович',
            'application_id' => 2,
        ]);
        DB::table('preparation')->insert([
            'school_one' => 'Сумська Музична школа 1',
            'school_address' => 'м.Суми, вул.Засумська 1',
            'school_email' => 'email@school.lol1',
            'school_phone' => '+380502864031',
            'teacher_name' => 'Иван 1',
            'teacher_surname' => 'Иванов 1',
            'teacher_patronomic' => 'Иванович',
            'teacher_in' => '880055535351',
            'teacher_email' => 'teacher@email.com1',
            'teacher_phone' => '+380502864031',
            'is_concertmaster' => 1,
            'concertmaster_name' => 'Виктор',
            'concertmaster_surname' => 'Федорович',
            'concertmaster_patronomic' => 'Концертмейстерович',
            'application_id' => 3,
        ]);
    }
}