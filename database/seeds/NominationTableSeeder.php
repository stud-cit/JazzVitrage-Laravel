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
            'nomination_id' => 1,
            'name' => 'інструментальний  жанр, вокальний жанр',
        ]);
        DB::table('nomination')->insert([
            'nomination_id' => 2,
            'name' => 'інструментальний жанр',
        ]);
        DB::table('nomination')->insert([
            'nomination_id' => 3,
            'name' => 'композиція',
        ]);
    }
}
