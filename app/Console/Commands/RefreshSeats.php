<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Seat;
use App\Models\User;

class RefreshSeats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:seats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'refresh seats table';

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
        // 非ログイン状態のユーザーを退席
        $seats = Seat::whereNotNull('status')->get();

        foreach ($seats as $seat) {
            // 着席中のユーザーがいる場合
            if (!empty($seat->user)) {
                // ユーザーが非オンライン状態の場合
                if (!$seat->user->isOnline()) {
                    // シートの初期化
                    $seat->fill(['status' => null, 'reservation_user_id' => null])->save();
                    // ユーザーの退席処理
                    $seat->user->fill(['seat_id' => null, 'task_id' => null])->save();
                }
            }

            // 予約中のユーザーがいる場合
            if (!empty($seat->reservation_user_id)) {
                $reservation_user = User::find($seat->reservation_user_id);
                // ユーザーが非オンライン状態の場合
                if (!$reservation_user->isOnline()) {
                    // シートの初期化
                    $seat->fill(['status' => null, 'reservation_user_id' => null])->save();
                    // ユーザーの退席処理
                    $reservation_user->fill(['seat_id' => null, 'task_id' => null])->save();
                }
            }
        }

        return 0;
    }
}
