<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\PublishSystemDownEvent::class,
        Commands\PublishTimetableEvent::class,
        Commands\RefreshSeats::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // 毎日3時からメンテナンスモード
        $schedule->command('system:down');

        // 5分毎に時間割の通知
        $schedule->command('publishevent:timetable')->everyFiveMinutes();
        // 10分毎に座席を初期化
        $schedule->command('refresh:seats')->everyTenMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
