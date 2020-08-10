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
            'code' => 'callme',
            'iframe' => '<iframe
                        class="img-thumbnail"
                        src="https://www.youtube.com/embed/vTlSEMdC5qw"
                        allowfullscreen
                        ></iframe>',
            'info' => '<strong>App para convertir visitas en clientes</strong>
            <br>
            <p>Información genral de como instalar el widget Call Me en su página web</p> '
        ]);
    }
}
