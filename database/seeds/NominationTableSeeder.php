<?php

use Illuminate\Database\Seeder;

class NominationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nomination')->insert([
            'name' => 'Вокальний жанр',
            'logo' => '/img/microphone.png'
        ]);
        DB::table('nomination')->insert([
            'name' => 'Інструментальний жанр',
            'logo' => '/img/piano.png'
        ]);
        DB::table('nomination')->insert([
            'name' => 'Композиція',
            'logo' => '/img/nots.png'
        ]);
    }
}
