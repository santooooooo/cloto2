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
         * 毎日午前0~1時はメンテナンス
         */
        // 0:00にシステムを停止
        $schedule->command('system:down')->dailyAt('0:00');
        // 0:05に未着席ユーザー呼び出しツイート
        $schedule->command('call')->dailyAt('0:05')->evenInMaintenanceMode();

        //*** cron ***//
        // 0:10にSSL証明書を更新（1回目）
        // 0:20にSSL証明書を更新（2回目）
        // 0:30にバックアップ開始

        // 0:45にチャットデータ削除処理
        $schedule->command('refresh:chats')->dailyAt('0:45')->evenInMaintenanceMode();
        // 0:50に全員退席処理
        $schedule->command('refresh:seats')->dailyAt('0:50')->evenInMaintenanceMode();
        // 1:00にシステムを復旧
        $schedule->command('up')->dailyAt('1:00')->evenInMaintenanceMode();


        /**
         * アプリケーションイベント
         */
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
