<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            'name' => 'questions',
            'email' => 'questions@gmail.com',
            'question_text' => 'Чи є життя на марсі?',
        ]);
    }
}
