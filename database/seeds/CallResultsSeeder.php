<?php

use Illuminate\Database\Seeder;

class CallResultsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names=[
            'Completada',
            'No contesto',
            'Número Ocupado',
            'Número Equivocado',
            'Contestadora'
        ];
        foreach($names as $name){
            DB::table('call_results')->insert([
                'name' => $name
            ]);
        }
    }
}
