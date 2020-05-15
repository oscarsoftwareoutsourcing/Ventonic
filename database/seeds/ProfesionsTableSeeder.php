<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfesionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profesions=[
            [
                'sector_id'=> 1,
                'description'=>'Administrador de Empresas'
            ],
            [
                'sector_id'=> 1,
                'description'=>'Contador publico'
            ],
            [
                'sector_id'=> 2,
                'description'=>'Ing. Produccion Animal'
            ],
            [
                'sector_id'=> 2,
                'description'=>'Ing. Agrónomo'
            ],
            [
                'sector_id'=> 3,
                'description'=>'Ing. Tecnología de los Alimentos'
            ],
            [
                'sector_id'=> 3,
                'description'=>'Ayudante de Cocina'
            ],
            [
                'sector_id'=> 3,
                'description'=>'Chef'
            ],
            [
                'sector_id'=> 4,
                'description'=>'Comunity Manager'
            ],
            [
                'sector_id'=> 4,
                'description'=>'Reportero Gráfico'
            ],
            [
                'sector_id'=> 5,
                'description'=>'Agente de inmobialiario'
            ],
            [
                'sector_id'=> 5,
                'description'=>'Arquitecto'
            ],
            [
                'sector_id'=> 6,
                'description'=>'Especialista en control de inventarios'
            ],
            [
                'sector_id'=> 6,
                'description'=>'Almacenista'
            ],
            [
                'sector_id'=> 7,
                'description'=>'Vendedor'
            ],
            [
                'sector_id'=> 8,
                'description'=>'Maestro de Obra'
            ],
            [
                'sector_id'=> 8,
                'description'=>'Minero'
            ],
            [
                'sector_id'=> 9,
                'description'=>'Entrenador Personal'
            ],
            [
                'sector_id'=> 9,
                'description'=>'Futbolista Profesional'
            ],
            [
                'sector_id'=> 10,
                'description'=>'Profesor Filososofia y Lenguas'
            ],
            [
                'sector_id'=> 10,
                'description'=>'Lcdo. Educacion Especial'
            ],
            [
                'sector_id'=> 11,
                'description'=>'Ing. Petroleo'
            ],
            [
                'sector_id'=> 11,
                'description'=>'Ing. Quimico'
            ],
            [
                'sector_id'=> 12,
                'description'=>'Corredor de Seguros'
            ],
            [
                'sector_id'=> 13,
                'description'=>'Guía Turistico'
            ],
            [
                'sector_id'=> 13,
                'description'=>'Especialista en Idiomas'
            ],
            [
                'sector_id'=> 14,
                'description'=>'Diseñador Gráfico'
            ],
            [
                'sector_id'=> 14,
                'description'=>'Desarrollador Web'
            ],
            [
                'sector_id'=> 15,
                'description'=>'Ing. ed Ambiente y Recursos Naturales'
            ],
            [
                'sector_id'=> 16,
                'description'=>'Ing. Metalurgico'
            ],
            [
                'sector_id'=> 17,
                'description'=>'Capitan de Navio'
            ],
            [
                'sector_id'=> 18,
                'description'=>'Soldador'
            ],

            [
                'sector_id'=> 18,
                'description'=>'Operador de maquinaria de corte'
            ],
            [
                'sector_id'=> 19,
                'description'=>'Medico Cirujano'
            ],
            [
                'sector_id'=> 19,
                'description'=>'Lcda. Enfermería'
            ],
            [
                'sector_id'=> 19,
                'description'=>'Bionalista'
            ],
            [
                'sector_id'=> 19,
                'description'=>'Otorrinolaringologo'
            ],
            [
                'sector_id'=> 20,
                'description'=>'Consultor empresarial'
            ],
            [
                'sector_id'=> 21,
                'description'=>'Ing. Telecomunicaciones'
            ],
            [
                'sector_id'=> 22,
                'description'=>'Diseñadora de pieles e interiores'
            ],
            [
                'sector_id'=> 22,
                'description'=>'Modelo Profesional'
            ],
            [
                'sector_id'=> 23,
                'description'=>'Transportista'
            ]
        ];
        foreach($profesions as $profesion){
            DB::table('profesions')->insert([
                'sector_id' => $profesion['sector_id'],
                'description' => $profesion['description'],
            ]);
        }
    }
}
