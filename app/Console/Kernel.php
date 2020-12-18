<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Carbon;
use App\Models\Room;
use App\Events\TimetableEvent;

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
        // 5分毎に時間割の通知
        $schedule->call(function () {
            $now = Carbon::now()->format('H:i');
            $rooms = Room::all();

            // 全部屋に実行
            foreach ($rooms as $room) {
                // 現在時刻が時間割に存在する時刻の場合
                if (array_key_exists($now, $room->timetable)) {
                    // 次の時間割の状態を送信
                    broadcast(new TimetableEvent($room, $now));
                }
            }
        })->everyFiveMinutes();
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
