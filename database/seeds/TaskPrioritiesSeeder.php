<?php

use Illuminate\Database\Seeder;

class TaskPrioritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $types=[
            'Ninguna',
            'Baja',
            'Media',
            'Alta',
            'Urgente'
        ];
        foreach($types as $type){
            DB::table('task_priorities')->insert([
                'name' => $type
            ]);
        }
    }
    
}
