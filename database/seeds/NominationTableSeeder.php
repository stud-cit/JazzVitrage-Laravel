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
        ]);
        DB::table('nomination')->insert([
            'name' => 'Інструментальний жанр',
        ]);
        DB::table('nomination')->insert([
            'name' => 'Композиція',
        ]);
    }
}
