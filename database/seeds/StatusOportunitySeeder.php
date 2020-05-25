<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusOportunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses=[
            'no publicada',
            'activa',
            'cancelada',
            'cerrada'

        ];
        foreach($statuses as $status){
            DB::table('status_oportunitys')->insert([
                'description' => $status
            ]);
        }
    }
}
