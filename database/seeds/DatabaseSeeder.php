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
            //ApplicationTableSeeder::class,
            //GroupPeopleTableSeeder::class,
            //PreparationTableSeeder::class,
            //PresentationTableSeeder::class,
            //SoloDuetTableSeeder::class,
            ContactSectionSeeder::class,
            ContactItemsSeeder::class,
            HymnSectionSeeder::class,
            LogoSectionSeeder::class,
            PositionSectionSeeder::class,
            //VideoGallerySectionSeeder::class,
            // FotoGalleryTableSeeder::class,
            UsersTableSeeder::class,
            QuotesTableSeeder::class,
            //QuestionsTableSeeder::class,
            PeriodsTableSeeder::class,
        ]);
    }
}
