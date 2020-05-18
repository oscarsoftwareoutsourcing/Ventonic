<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeZoneOportunitysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timeZones=[
            'Cualquier zona horaria',
            'Zona horaria especificada'
        ];
        foreach($timeZones as $timeZone){
            DB::table('time_zone_oportunitys')->insert([
                'description' => $timeZone
            ]);
        }
    }
}
