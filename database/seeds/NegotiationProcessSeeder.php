<?php

use Illuminate\Database\Seeder;

class NegotiationProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $processes =[
            "Posibles Clientes",
            "Potencial Cliente",
            "En Contacto",
            "Reunión / Sesión",
            "En Negociación / Seguimiento",
            "Venta / Cerrado",

        ];

         foreach($processes as $process){
            DB::table('negotiation_process')->insert([
                'name' => $process
            ]);
        }
    }
}
