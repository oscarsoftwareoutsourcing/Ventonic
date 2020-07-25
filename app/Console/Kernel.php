<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        /** ejecuta la tarea programada de eliminar salas de chat inactivas, cada día a media noche */
        $schedule->call(function () {
            DB::select(
                'SELECT r.id, m.user_id FROM chat_rooms AS r
                INNER JOIN chat_room_user AS u ON r.id=u.chat_room_id
                LEFT JOIN messages AS m ON u.id=m.user_id
                WHERE r.created_at < NOW() - INTERVAL 1 DAY AND m.user_id is NULL
                GROUP BY r.id, r.created_at, m.user_id'
            );
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
