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
        Commands\SystemDown::class,
        Commands\CheckTimetable::class,
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
        // 3:00にシステムを停止
        $schedule->command('down')->dailyAt('3:00');
        $schedule->command('system:down')->dailyAt('3:00')->evenInMaintenanceMode();

        //*** cron ***//
        // 3:10にSSL証明書を更新（1回目）
        // 3:20にSSL証明書を更新（2回目）
        // 3:30にバックアップ開始

        // 4:40に全員退席処理
        $schedule->command('refresh:seats')->dailyAt('4:40')->evenInMaintenanceMode();
        // 4:50にシステムを復旧
        $schedule->command('up')->dailyAt('4:50')->evenInMaintenanceMode();


        /**
         * アプリケーションイベント
         */
        // 5分毎に時間割の通知
        $schedule->command('check:timetable')->everyFiveMinutes();
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
