<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusAplicantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses=[
            'inscrito',
            'en proceso',
            'seleccionado',
            'descartado',
            'cancelado'

        ];
        foreach($statuses as $status){
            DB::table('status_postulations')->insert([
                'description' => $status
            ]);
        }
    }
}
