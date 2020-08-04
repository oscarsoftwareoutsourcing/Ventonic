<?php

use Illuminate\Database\Seeder;

class TaskQueueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $queues=[
            'Ventonic',
            'Correo propio'
        ];
        foreach($queues as $queue){
            DB::table('task_queues')->insert([
                'name' => $queue
            ]);
        }
    }
}
