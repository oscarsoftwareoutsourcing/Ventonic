<?php

use Illuminate\Database\Seeder;

class UserModuleLabelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_module_labels')->insert([
            [
                'user_id' => 9,
                'module_id' => 2,
                'labels' => json_encode([
                    'processes' => [
                        ["id" => 1, "title" => "Posibles Clientes"],
                        ["id" => 2, "title" => "Potencial Cliente"],
                        ["id" => 3, "title" => "En Contacto"],
                        ["id" => 4, "title" => "Reunión / Sesión"],
                        ["id" => 5, "title" => "En Negociación / Seguimiento"],
                        ["id" => 6, "title" => "Venta / Cerrado"],
                    ]
                ]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => NULL
            ]
        ]);
    }
}
