<?php

use Illuminate\Database\Seeder;

class ContactSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact_section')->insert([
            'contact_section_id' => 1,
            'caption' => 'address',
        ]);
        DB::table('contact_section')->insert([
            'contact_section_id' => 2,
            'caption' => 'phones',
        ]);
        DB::table('contact_section')->insert([
            'contact_section_id' => 3,
            'caption' => 'socials',
        ]);
        DB::table('contact_section')->insert([
            'contact_section_id' => 4,
            'caption' => 'emails',
        ]);
    }
}
