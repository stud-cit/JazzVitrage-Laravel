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
        $this->call([
            NominationTableSeeder::class,
            ApplicationTypeTableSeeder::class,
            ContactSectionSeeder::class,
            ContactItemsSeeder::class,
            HymnSectionSeeder::class,
            LogoSectionSeeder::class,
            PositionSectionSeeder::class,
            UsersTableSeeder::class,
            QuotesTableSeeder::class,
            PeriodsTableSeeder::class,
            MasterClassTableSeeder::class,
            UsersMessagesTableSeeder::class,
        ]);
    }
}
