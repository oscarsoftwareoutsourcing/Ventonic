<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NegotiationStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('negotiation_statuses')->insert([
            [
                'status' => 'Exitosa',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => NULL
            ],
            [
                'status' => 'Perdida',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => NULL
            ],
            [
                'status' => 'En proceso',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => NULL
            ]
        ]);
    }
}
