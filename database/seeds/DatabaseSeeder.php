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
        // $this->call(UsersTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(JobsTypesTableSeeder::class);
        $this->call(SectorsOportunitiesTableSeeder::class);
        $this->call(UbicationsOportunitiesTableSeeder::class);
        $this->call(TimeZoneOportunitiesTableSeeder::class);
        $this->call(TypeOportunitiesTableSeeder::class);
        $this->call(ProfesionsTableSeeder::class);
        $this->call(AplicantsTableSeeder::class);
    }

    
}
