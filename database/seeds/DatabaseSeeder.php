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
        $this->call(SectorOportunitysTableSeeder::class);
        $this->call(UbicationOportunitysTableSeeder::class);
        $this->call(TimeZoneOportunitysTableSeeder::class);
        $this->call(TypeOportunitysTableSeeder::class);
        $this->call(ProfesionsTableSeeder::class);
        // $this->call(AplicantsTableSeeder::class);
    }

    
}
