<?php

use Illuminate\Database\Seeder;

class PresentationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('presentation')->insert([
            'composition_one' => 'Назва твору 1',
            'author_one' => 'Автор твору 1',
            'composition_two' => 'Назва твору 2',
            'author_two' => 'Автор твору 2',
            'video' => 'https://www.youtube.com/watch?v=UAxNcJprLA0',
            'application_id' => 1,
        ]);

        DB::table('presentation')->insert([
            'composition_one' => 'Назва твору 1',
            'author_one' => 'Автор твору 1',
            'composition_two' => 'Назва твору 2',
            'author_two' => 'Автор твору 2',
            'video' => 'https://www.youtube.com/watch?v=NNdTljRzPqE',
            'application_id' => 2,
        ]);

        DB::table('presentation')->insert([
            'composition_one' => 'Назва твору 1',
            'author_one' => 'Автор твору 1',
            'composition_two' => 'Назва твору 2',
            'author_two' => 'Автор твору 2',
            'video' => 'https://www.youtube.com/watch?v=Wx_r_wap-Jg',
            'application_id' => 3,
        ]);

        DB::table('presentation')->insert([
            'composition_one' => 'Назва твору 1',
            'author_one' => 'Автор твору 1',
            'composition_two' => 'Назва твору 2',
            'author_two' => 'Автор твору 2',
            'video' => 'https://www.youtube.com/watch?v=Wx_r_wap-Jg',
            'application_id' => 4,
        ]);

        DB::table('presentation')->insert([
            'composition_one' => 'Назва твору 1',
            'author_one' => 'Автор твору 1',
            'composition_two' => 'Назва твору 2',
            'author_two' => 'Автор твору 2',
            'video' => 'https://www.youtube.com/watch?v=Wx_r_wap-Jg',
            'application_id' => 5,
        ]);

        DB::table('presentation')->insert([
            'composition_one' => 'Назва твору 1',
            'author_one' => 'Автор твору 1',
            'composition_two' => 'Назва твору 2',
            'author_two' => 'Автор твору 2',
            'video' => 'https://www.youtube.com/watch?v=Wx_r_wap-Jg',
            'application_id' => 6,
        ]);

        DB::table('presentation')->insert([
            'composition_one' => 'Назва твору 1',
            'author_one' => 'Автор твору 1',
            'composition_two' => 'Назва твору 2',
            'author_two' => 'Автор твору 2',
            'video' => 'https://www.youtube.com/watch?v=Wx_r_wap-Jg',
            'application_id' => 7,
        ]);
    }
}
