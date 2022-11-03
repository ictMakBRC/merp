<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('queue:restart')->everyFiveMinutes();
        Log::info('working');
        // $schedule->command('queue:work --daemon')->everyMinute()->withoutOverlapping();
        // $schedule->command('contract:update-status')->daily()->appendOutputTo('contractupdates.log');
        // $schedule->command('notice:delete')->daily();
        // $schedule->command('birthday:sendwishes')->daily()->appendOutputTo('birthdayupdates.log');
        // $schedule->command('holiday:send-notification')->daily()->appendOutputTo('holidatupdates.log');
        // $schedule->command('queue:retry all')->everyFiveMinutes()->appendOutputTo('jobsretried.log');
    }

    // $schedule->command('queue:restart')
    // ->everyFiveMinutes();
    // if (!strstr(shell_exec('ps xf'), 'php artisan queue:work')) {
    //     $schedule->command('queue:work')
    //              ->everyMinute();
    // }
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
