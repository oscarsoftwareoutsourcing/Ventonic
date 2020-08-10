<?php

use Illuminate\Database\Seeder;

class AppsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('apps')->insert([
            'name' => 'Call Me',
            'description' => 'App para convertir visitas en clientes',
            'type' => 'pub',
            'type_user' => 'E',
            'widget_type' => 'freeapps',
            'image' =>'images/pages/apps/call_me.jpeg',
            'code' => 'callme'
        ]);
    }
}
