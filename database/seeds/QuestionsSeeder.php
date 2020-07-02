<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Question;

class QuestionsSeeder extends Seeder
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
                    'option_type' => 'V',
                    'selection_type' => 'M',
                    'priority' => 6,
                    'name' => 'Sector al que te dedicas',
                    'options' => [
                        'Administración gubernamental',
                        'Aeronáutica/ Aviación',
                        'Agricultura',
                        'Alimentación y bebidas',
                        'Almacenamiento',
                        'Animación',
                        'Apuestas y casinos',
                        'Arquitectura y planificación',
                        'Artes escénicas',
                        'Artesanía',
                        'Artículos de consumo',
                        'Artículos de lujo y joyas',
                        'Artículos deportivos',
                        'Atención a la salud mental',
                        'Atención sanitaria y hospitalaria',
                        'Automatización industrial',
                        'Banca',
                        'Banca de inversiones',
                        'Bellas Artes',
                        'Bibliotecas',
                        'Bienes inmobiliarios',
                        'Biotecnología',
                        'Capital de riesgo y capital privado',
                        'Construcción',
                        'Construcción naval',
                        'Consultoría de estrategia y operaciones',
                        'Contabilidad',
                        'Cosmética',
                        'Cristal, cerámica y hormigón',
                        'Cumplimiento de la ley',
                        'Departamento de defensa y del espacio exterior', 
                        'Deportes',
                        'Derecho',
                        'Desarrollo de programación',
                        'Desarrollo y comercio exterior',
                        'Diseño',
                        'Diseño gráfico',
                        'Dotación y selección de personal',
                        'E-learning',
                        'Educación primaria/secundaria',
                        'Ejército',
                        'Electrónica de consumo',
                        'Embalaje y contenedores',
                        'Energía renovable y medio ambiente',
                        'Enseñanza superior',
                        'Entretenimiento',
                        'Envío de paquetes y carga',
                        'Equipos informáticos',
                        'Escritura y edición',
                        'Filantropía',
                        'Formación personal y capacitación',
                        'Fotografía',
                        'Gabinetes estratégicos',
                        'Ganadería',
                        'Gestión de inversiones',
                        'Gestión de organizaciones sin ánimo de lucro',
                        'Gestión educativa',
                        'Hostelería',
                        'Importación y exportación',
                        'Imprenta',
                        'Industria aeroespacial y aviación',
                        'Industria farmacéutica',
                        'Industria textil y moda',
                        'Ingeniería civil',
                        'Ingeniería industrial o mecánica',
                        'Instalaciones y servicios recreativos',
                        'Instituciones religiosas',
                        'Interconexión en red',
                        'Internet',
                        'Investigación',
                        'Investigación de mercado',
                        'Judicial',
                        'Lácteos',
                        'Logística y cadena de suministro',
                        'Manufactura eléctrica/electrónica',
                        'Manufactura ferroviaria',
                        'Maquinaria',
                        'Marketing y publicidad',
                        'Material y equipo de negocios',
                        'Materiales de construcción',
                        'Medicina alternativa',
                        'Medios de comunicación en línea',
                        'Medios de difusión',
                        'Mercados de capital',
                        'Minería y metalurgia',
                        'Mobiliario',
                        'Museos e instituciones',
                        'Música',
                        'Nanotecnología',
                        'Naval',
                        'Ocio, viajes y turismo',
                        'Oficina ejecutiva',
                        'Oficina legislativa',
                        'Organización cívica y social',
                        'Organización política',
                        'Películas y cine',
                        'Periódicos',
                        'Petróleo y energía',
                        'Piscicultura',
                        'Plásticos',
                        'Política pública',
                        'Producción alimentaria',
                        'Producción multimedia',
                        'Productos de papel y forestales',
                        'Productos químicos',
                        'Profesiones médicas',
                        'Protección civil',
                        'Publicaciones',
                        'Recaudación de fondos',
                        'Recursos humanos',
                        'Relaciones gubernamentales',
                        'Relaciones públicas y comunicaciones',
                        'Resolución de conflictos por terceras partes',
                        'Restaurantes',
                        'Sanidad, bienestar y ejercicio',
                        'Sector automovilístico',
                        'Sector textil',
                        'Seguridad del ordenador y de las redes',
                        'Seguridad e investigaciones',
                        'Seguros',
                        'Semiconductores',
                        'Servicio al consumidor',
                        'Servicio de información',
                        'Servicios de eventos',
                        'Servicios financieros',
                        'Servicios infraestructurales',
                        'Servicios jurídicos',
                        'Servicios médicos',
                        'Servicios medioambientales',
                        'Servicios para el individuo y la familia',
                        'Servicios públicos',
                        'Servicios y tecnología de la información',
                        'Software',
                        'Subcontrataciones/Offshoring',
                        'Supermercados',
                        'Tabacos',
                        'Tecnología inalámbrica',
                        'Telecomunicaciones',
                        'Traducción y localización',
                        'Transporte por carretera o ferrocarril',
                        'Venta al por mayor',
                        'Venta al por menor',
                        'Veterinaria',
                        'Videojuegos',
                        'Vídeos y licores'                    ]
                ]
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
