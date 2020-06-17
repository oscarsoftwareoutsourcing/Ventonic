<?php

use Illuminate\Database\Seeder;

class ModuleLabelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('module_labels')->insert([
            'module' => 'Todos',
            'labels' => json_encode([
                ["id" => 1, "label" => "Etiqueta #1"],
                ["id" => 2, "label" => "Etiqueta #2"],
                ["id" => 3, "label" => "Etiqueta #3"],
                ["id" => 4, "label" => "Etiqueta #4"],
            ]),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => NULL
        ]);
    }
}
