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
        $this->call(UsersSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(JobsTypesTableSeeder::class);
        $this->call(SectorOportunitysTableSeeder::class);
        $this->call(UbicationOportunitysTableSeeder::class);
        $this->call(TimeZoneOportunitysTableSeeder::class);
        $this->call(TypeOportunitysTableSeeder::class);
        $this->call(ProfesionsTableSeeder::class);
        $this->call(StatusOportunitySeeder::class);
        $this->call(AptitudSeeder::class);
        $this->call(StatusAplicantsSeeder::class);
        $this->call(NegotiationStatusesSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(ModuleLabelsSeeder::class);
        $this->call(QuestionsSeeder::class);
        $this->call(TaskPrioritiesSeeder::class);
        $this->call(TaskQueueSeeder::class);
        $this->call(TaskTypesSeeder::class);
        // $this->call(GroupSeeder::class);
        // $this->call(AplicantsTableSeeder::class);
    }


}
