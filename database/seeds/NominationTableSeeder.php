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
            'name' => 'інструментальний жанр',
        ]);
        DB::table('nomination')->insert([
            'name' => 'композиція',
        ]);
    }
}
