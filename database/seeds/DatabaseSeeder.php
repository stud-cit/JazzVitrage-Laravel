<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(NominationTableSeeder::class);
        $this->call(ApplicationTypeTableSeeder::class);
        $this->call(ApplicationTableSeeder::class);
        $this->call(GroupPeopleTableSeeder::class);
        $this->call(PreparationTableSeeder::class);
        $this->call(PresentationTableSeeder::class);
        $this->call(SoloDuetTableSeeder::class);
    }
}
