<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorsOportunitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectors=[
            'SECTOR ADMINISTRACIÓN Y GESTIÓN (OFICINAS Y DESPACHOS)',
            'SECTOR AGRICULTURA Y GANADERÍA',
            'SECTOR INDUSTRIA ALIMENTARIA',
            'SECTOR DE INFOPRODUCTOS DIGITALES',
            'SECTOR INMOBILIARIO',
            'SECTOR GRANDES ALMACENES',
            'SECTOR COMERCIO',
            'SECTOR CONSTRUCCIÓN E INDUSTRIAS EXTRACTIVAS',
            'SECTOR ACTIVIDADES FÍSICO-DEPORTIVAS',
            'SECTOR EDUCACIÓN',
            'SECTOR ENERGÍA Y AGUA',
            'SECTOR FINANZAS Y SEGUROS',
            'SECTOR HOSTELERÍA Y TURISMO',
            'SECTOR INFORMACIÓN, COMUNICACIÓN Y ARTES GRÁFICAS',
            'SECTOR SERVICIOS MEDIOAMBIENTALES',
            'SECTOR METAL',
            'SECTOR PESCA Y ACUICULTURA',
            'SECTOR INDUSTRIA QUÍMICA Y VIDRIO',
            'SECTOR SANIDAD',
            'SECTOR SERVICIOS A LAS EMPRESAS',
            'SECTOR DE TELECOMUNICACIONES',
            'SECTOR TEXTIL, CONFECCIÓN Y PIEL',
            'SECTOR TRANSPORTE Y LOGÍSTICA',
        ];
        foreach($sectors as $sector){
            DB::table('sectors_oportunities')->insert([
                'description' => $sector
            ]);
        }
    }
}
