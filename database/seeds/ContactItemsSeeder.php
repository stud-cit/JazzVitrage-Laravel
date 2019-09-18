<?php

use Illuminate\Database\Seeder;

class ContactItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact-items')->insert([
            'contact_section_id' => 1,
            'contact' => 'Суми, Сумська область, 40000',
        ]);
        DB::table('contact-items')->insert([
            'contact_section_id' => 2,
            'contact' => '0542 330 032',
        ]);
        DB::table('contact-items')->insert([
            'contact_section_id' => 3,
            'contact_title' => 'Facebook',
            'contact' => 'https://school-link.com',
        ]);
        DB::table('contact-items')->insert([
            'contact_section_id' => 4,
            'contact' => 'music-concurs@email.com',
        ]);
    }
}
