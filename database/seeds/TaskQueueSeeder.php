<?php

use Illuminate\Database\Seeder;
use App\TaskQueue;

class TaskQueueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $queues = [
            'Email',
            'Mensaje de texto',
            'Llamada'
        ];

        foreach ($queues as $queue) {
            TaskQueue::firstOrCreate(['name' => $queue], []);
        }
    }
}
