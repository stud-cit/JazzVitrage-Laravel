<?php

use Illuminate\Database\Seeder;

class PositionSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('position_section')->insert([
            'provisions_text' => 'ротягом березня-квітня 2016 року в місті Суми проходив Другий обласний дитячий фестиваль-конкурс джазової музики "Джаз Вітраж". 
            Головна мета цього нового творчого проекту - популяризація класичного та сучасного джазового мистецтва серед дітей та молоді',
            'video' => 'відео з YouTube',
            'file' => 'файл документу про положення конкурсу',
        ]);
    }
}
