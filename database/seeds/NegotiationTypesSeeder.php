<?php

use Illuminate\Database\Seeder;

class NegotiationTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('negotiation_types')->insert([
            [
                'type' => 'Tipo #1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => NULL
            ],
            [
                'type' => 'Tipo #2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => NULL
            ],
            [
                'type' => 'Tipo #3',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => NULL
            ]
        ]);
    }
}
