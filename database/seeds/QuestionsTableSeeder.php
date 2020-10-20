<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::transaction(function () {
            $questions = [
                [
                    'option_type' => 'E',
                    'selection_type' => 'U',
                    'priority' => 1,
                    'name' => 'Sector al que te dedicas',
                    'options' => [
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
                    ]
                ],
                [
                    'option_type' => 'V',
                    'selection_type' => 'U',
                    'priority' => 1,
                    'name' => 'Años de experiencia en ventas',
                    'options' => [
                        'Menos de 1 año',
                        'Entre 1 y 3 años',
                        'Entre 3 y 5 años',
                        'Más de 5 años',
                    ]
                ],
                [
                    'option_type' => 'V',
                    'selection_type' => 'M',
                    'priority' => 2,
                    'name' => 'Selecciona la/s opciones dónde tienes experiencia demostrable',
                    'options' => [
                        'Tengo experiencia vendiendo por teléfono productos físicos.',
                        'Tengo experiencia vendiendo por teléfono servicios (consultoría, infoproductos).',
                        'Tengo experiencia vendiendo a puerta fría.',
                        'Tengo experiencia como vendedor trabajando en un lugar físico.',
                        'Tengo experiencia con visitas presenciales a empresas.',
                    ]
                ],
                [
                    'option_type' => 'V',
                    'selection_type' => 'U',
                    'priority' => 3,
                    'name' => 'Ahora mismo cuál sería tu disponibilidad',
                    'options' => [
                        'Por las mañanas',
                        'Por las tardes',
                        'A tiempo completo',
                        'No tengo disponibilidad',
                    ]
                ],
                [
                    'option_type' => 'V',
                    'selection_type' => 'U',
                    'priority' => 4,
                    'name' => '¿Qué tipo de colaboración te interesa?',
                    'options' => [
                        'Por comisión exclusivamente',
                        'Un fijo mensual y una comisión',
                    ]
                ],
                [
                    'option_type' => 'V',
                    'selection_type' => 'M',
                    'priority' => 5,
                    'name' => '¿Con qué CRM tienes experiencia?',
                    'options' => [
                        'Hubspot',
                        'Zoho',
                        'SumaCRM',
                        'Infusionsoft',
                        'ActiveCampaign',
                        'Pipedrive',
                        'Close.io',
                        'Salesforce',
                    ]
                ],
                [
                    'option_type' => 'V',
                    'selection_type' => 'U',
                    'priority' => 6,
                    'name' => 'Ventas anuales',
                    'options' => [
                        '< 25.000€',
                        '25.000€ - 250.000€',
                        'A tiempo completo',
                        '250.000€ - 1.000.000€',
                    ]
                ],
                [
                    'option_type' => 'V',
                    'selection_type' => 'U',
                    'priority' => 7,
                    'name' => 'Sector al que te dedicas',
                    'options' => [
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
                    ]
                ],
            ];

            foreach ($questions as $question) {
                Question::updateOrCreate(
                    [
                        'option_type' => $question['option_type'],
                        'name' => $question['name']
                    ],
                    [
                        'selection_type' => $question['selection_type'],
                        'priority' => $question['priority'],
                        'options' => json_encode($question['options'])
                    ]
                );
            }
        });
    }
}
