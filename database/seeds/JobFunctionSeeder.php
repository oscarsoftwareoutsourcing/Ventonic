<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\JobFunction;

class JobFunctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobFunctions = [
            'Administración',
            'Análisis',
            'Arte/Creatividad',
            'Atención al cliente',
            'Atención médica',
            'Cadena de abastecimiento',
            'Ciencias',
            'Compras',
            'Consultoría',
            'Contabilidad/Auditorías',
            'Control de calidad',
            'Desarrollo empresarial',
            'Diseño',
            'Distribución',
            'Educación',
            'Estrategia/planificación',
            'Finanzas',
            'Formación',
            'Gestión',
            'Gestión de productos',
            'Gestión de proyectos',
            'Ingeniería',
            'Investigación',
            'Legal',
            'Marketing',
            'Manufactura',
            'Negocios',
            'Producción',
            'Publicidad',
            'Recursos humanos',
            'Redacción y Revisión',
            'Relaciones públicas',
            'Tecnología de la información',
            'Ventas',
            'Otros'
        ];

        DB::transaction(function () use ($jobFunctions) {
            foreach ($jobFunctions as $jobFunction) {
                JobFunction::updateOrCreate(['name' => $jobFunction], []);
            }
        });
    }
}
