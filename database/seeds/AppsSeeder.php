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
            'description' => 'Widget para registro de llamadas',
            'type' => 'pub',
            'type_user' => 'E',
            'widget_type' => 'App\Widget'
        ]);
    }
}
