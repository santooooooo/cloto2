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
        $schedule->command('system:down')->dailyAt('3:00');

        //*** cron ***//
        // 3:10にSSL証明書を更新（1回目）
        // 3:20にSSL証明書を更新（2回目）
        // 3:30にバックアップ開始

        // 4:30にチャットデータ削除処理
        $schedule->command('refresh:chats')->dailyAt('4:30')->evenInMaintenanceMode();
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


        /**
         * オープン時間の制限（月~金）
         */
        // 0:00にシステムを停止
        $schedule->command('system:down')->weekdays()->at('0:00');

        // システムイベントにより4:50にシステムが復旧

        // 4:50にシステムを停止（即停止するためメンテナンス中と認識される）
        $schedule->command('system:down')->weekdays()->at('4:50')->evenInMaintenanceMode();
        // 5:40に全員退席処理
        $schedule->command('refresh:seats')->weekdays()->at('5:40')->evenInMaintenanceMode();
        // 6:00にシステムを復旧
        $schedule->command('up')->weekdays()->at('6:00')->evenInMaintenanceMode();

        // 9:00にシステムを停止
        $schedule->command('system:down')->weekdays()->at('9:00');
        // 19:40に全員退席処理
        $schedule->command('refresh:seats')->weekdays()->at('19:40')->evenInMaintenanceMode();
        // 20:00にシステムを復旧
        $schedule->command('up')->weekdays()->at('20:00')->evenInMaintenanceMode();

        /**
         * オープン時間の制限（土日）
         */
        // 0:00にシステムを停止
        $schedule->command('system:down')->weekends()->at('0:00');

        // システムイベントにより4:50にシステムが復旧

        // 4:50にシステムを停止（即停止するためメンテナンス中と認識される）
        $schedule->command('system:down')->weekends()->at('4:50')->evenInMaintenanceMode();
        // 11:40に全員退席処理
        $schedule->command('refresh:seats')->weekends()->at('11:40')->evenInMaintenanceMode();
        // 12:00にシステムを復旧
        $schedule->command('up')->weekends()->at('12:00')->evenInMaintenanceMode();
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
