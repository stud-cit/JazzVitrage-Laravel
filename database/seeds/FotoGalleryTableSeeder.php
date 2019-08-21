<?php

use Illuminate\Database\Seeder;

class FotoGalleryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('foto_gallery')->insert([
            'file' => 'test.png',
            'type' => 'Джаз-Вітраж',
            'year' => '2019',
        ]);
        DB::table('foto_gallery')->insert([
            'file' => 'test.png',
            'type' => 'Джаз-Вітраж',
            'year' => '2019',
        ]);
        DB::table('foto_gallery')->insert([
            'file' => 'test.png',
            'type' => 'Джаз-Вітраж',
            'year' => '2019',
        ]);
    }
}
