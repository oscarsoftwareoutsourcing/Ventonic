<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeOportunitysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $types=[
            'Publica un empleo',
            'Ayuda a alguien que conoces a encontrar candidatos',
            'Comparte un enlace que encontraste (Fuera de Torre).'
        ];
        foreach($types as $type){
            DB::table('type_oportunitys')->insert([
                'description' => $type
            ]);
        }
    }
}
