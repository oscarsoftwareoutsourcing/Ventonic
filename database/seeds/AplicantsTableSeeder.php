<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AplicantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aplicants=[
            [
                'profesion_id'=> 1,
                'name'=>'Sergio Cadenas'
            ],
            [
                'profesion_id'=> 1,
                'name'=>'Luisana Ordoñez'
            ],
            [
                'profesion_id'=> 1,
                'name'=>'Marcos Rojas'
            ],
            [
                'profesion_id'=> 2,
                'name'=>'Pedro Orduñez'
            ],
            [
                'profesion_id'=> 3,
                'name'=>'José Hernández'
            ],
            [
                'profesion_id'=> 3,
                'name'=>'Luisa Freites'
            ],
            [
                'profesion_id'=> 5,
                'name'=>'Merlí Fragata'
            ],
            [
                'profesion_id'=> 7,
                'name'=>'Eugeni Reyes'
            ],
            [
                'profesion_id'=> 9,
                'name'=>'Carlos Jimenez'
            ],
            [
                'profesion_id'=> 9,
                'name'=>'Menna Fitté'
            ],
            [
                'profesion_id'=> 12,
                'name'=>'Antonio Lopez'
            ]
        ];
        foreach($aplicants as $aplicant){
            DB::table('aplicants')->insert([
                'profesion_id' => $aplicant['profesion_id'],
                'name' => $aplicant['name'],
            ]);
        }
    }
}
