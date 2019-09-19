<?php

use Illuminate\Database\Seeder;

class QuotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quotes')->insert([
            'text' => 'Протягом березня-квітня 2016 року в місті Суми проходив Другий обласний дитячий фестиваль-конкурс джазової музики «Джаз Вітраж». Головна мета цього нового творчого проекту - популяризація класичного та сучасного джазового мистецтва серед дітей та молоді сумського краю'
        ]);
    }
}
