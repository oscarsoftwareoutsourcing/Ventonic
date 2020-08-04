<?php

use Illuminate\Database\Seeder;

class TaskTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types=[
            'Otros',
            'Presupuesto',
            'Llamada'
        ];
        foreach($types as $type){
            DB::table('task_types')->insert([
                'name' => $type
            ]);
        }
    }
}
