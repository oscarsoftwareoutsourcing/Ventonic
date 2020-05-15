<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobsTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types=[
            'Empleado de tiempo completo',
            'Empleado de medio tiempo',
            'Freelancer / Contratista',
            'Pasante',
            'Consultor'
        ];
        foreach($types as $type){
            DB::table('job_types')->insert([
                'description' => $type
            ]);
        }
    }
}
