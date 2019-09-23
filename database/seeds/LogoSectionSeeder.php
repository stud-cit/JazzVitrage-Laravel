<?php

use Illuminate\Database\Seeder;

class LogoSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logo_section')->insert([
            'logo' => '/img/logo.svg',
            'description' => 'Протягом березня-квітня 2016 року в місті Суми проходив Другий обласний дитячий фестиваль-конкурс джазової музики «Джаз Вітраж». Головна мета цього нового творчого проекту - популяризація класичного та сучасного джазового мистецтва серед дітей та молоді сумського краю',
            'ticker' => 'Протягом березня-квітня 2016 року в місті Суми проходив Другий обласний дитячий фестиваль-конкурс джазової музики «Джаз Вітраж». Головна мета цього нового творчого проекту - популяризація класичного та сучасного джазового мистецтва серед дітей та молоді сумського краю',
        ]);
    }
}