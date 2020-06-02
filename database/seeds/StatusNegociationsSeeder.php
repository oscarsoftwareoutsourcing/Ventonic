<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusNegociationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status=[
            [
                'description'=>'No conseguida',
                'type'=> 'company',
            ],
            [
                'description'=>'Conseguida',
                'type'=> 'company',
            ],
            [
                'description'=>'En proceso',
                'type'=> 'company',
            ],
            [
                'description'=>'Negociacion no ganada',
                'type'=> 'Seller',
            ],
            [
                'description'=>'Negociacion ganada',
                'type'=> 'Seller',
            ],
            [
                'description'=>'Negociacion en proceso',
                'type'=> 'Seller',
            ],
        ];
        foreach($status as $statu){
            DB::table('status_negociations')->insert([
                'description' => $statu['description'],
                'type' => $statu['type']
            ]);
        }
    }
}
