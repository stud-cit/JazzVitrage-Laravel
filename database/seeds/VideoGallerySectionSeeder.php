<?php

use Illuminate\Database\Seeder;

class VideoGallerySectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('video_gallery')->insert([
            'url' => 'https://www.youtube.com/watch?v=fMKZMI8ByTs',
            'year' => 2019
        ]);
    }
}
