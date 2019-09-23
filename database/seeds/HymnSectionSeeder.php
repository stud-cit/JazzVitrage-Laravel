<?php

use Illuminate\Database\Seeder;

class HymnSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hymn_section')->insert([
            'hymn_text' => 'Куплет
Якщо твоє серце постійно співає,
Мелодія блюзу тебе надихає,
Якщо ти сміливий і маєш кураж –
На тебе чекає сумський «Джаз-Вітраж»!
Бо Джаз – то є символ свободи і миру.
Він-скарб неповторний, яскравий і щирий.
Давайте сьогодні покажемо клас
Анумо всі разом: «Ми любимо ДЖАЗ!»

Приспів
Джаз! Джаз! Джаз! Джаз!
Лунає джаз.
Єднає нас.
Хай буде джаз!
бо Джаз – це Джаз! ДЖАЗ!

Куплет
Вітаємо щиро цінителів Джазу
Віват, Джаз- Вітраж! Об&#39;єднаймося разом!
Щоб музику стильну усім дарувать,
у світ її дивний без гальм поринать:
Не варто сидіти і чогось чекати -
Ти просто повинен себе показати!
Вирує хай свято не день і не час
Віват Джаз-Вітраж! Хай завджди буде ДЖАЗ!',
'audio' => '/audio/jazz.wav',
'note_image' => '/img/hymn.jpg',
        ]);
    }
}