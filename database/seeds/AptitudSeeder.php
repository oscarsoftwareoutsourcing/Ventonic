<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AptitudSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aptitudes=[
            'Creatividad',
            'Persuasión',
            'Flexibilidad',
            'Iniciativa',
            'Resilencia',
            'Liderazgo',
            'Empatía',
            'Seguridad',
            'Honestidad',
            'Disciplina',
            'Inteligencia emocional',
            'Actitudes profesionales',
            'Adaptabilidad',
            'Gestión del tiempo',
            'Polivalencia',
            'Proactividad',
            'Capacidad de resolución',
            'Capacidad analítica',
            'Lealtad',
            'Perseverancia'
        ];
        foreach($aptitudes as $aptitud){
            DB::table('aptitudes')->insert([
                'description' => $aptitud
            ]);
        }
    }
}
