<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\Room;
use App\Events\RoomStatusChanged;

class CheckTimetable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:timetable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check timetable';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now()->format('H:i');
        $rooms = Room::all();

        // 全部屋に実行
        foreach ($rooms as $room) {
            // 現在時刻が時間割に存在する時刻の場合
            if (array_key_exists($now, $room->timetable)) {
                // 次の時間割の状態を送信
                broadcast(new RoomStatusChanged($room, $now));
            }
        }

        return 0;
    }
}
