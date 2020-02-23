<?php

use Illuminate\Database\Seeder;

class MasterClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_class')->insert([
            'logo_master' => '/img/master-item.png',
            'description_master' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.',
            'title_master' => 'Lorem Ipsum',
            'title_gallery_master' => 'Lorem Ipsum',
            'title_req_master' => 'Lorem Ipsum',
            'info_message' => 'Lorem Ipsum'
        ]);
    }
}
