<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbicationOportunitysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ubications=[
            'Remoto - cualquier parte',
            'Remoto - dentro de un pais - region',
            'Ubicacion fisica/oficina'
        ];
        foreach($ubications as $ubication){
            DB::table('ubication_oportunitys')->insert([
                'description' => $ubication
            ]);
        }
    }
}
