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
        /**
         * システムイベント
         * 毎日午前3~5時はメンテナンスモード
         */
        // 3:00にユーザーへ通知
        $schedule->command('system:down')->dailyAt('3:00');
        // 3:15にシステムを停止
        $schedule->command('down')->dailyAt('3:15');

        //*** cronでバックアップなどを実行 ***//

        // 4:45にシステムを復旧
        $schedule->command('up')->dailyAt('4:45');


        /**
         * アプリケーションイベント
         */
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
