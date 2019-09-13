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
            'hymn_text' => 'Текст гімну',
            'audio' => 'hymn-audio.flac',
            'note_image' => 'hymn.jpg',
        ]);
    }
}
