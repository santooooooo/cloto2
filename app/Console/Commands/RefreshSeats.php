<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\Seat;
use App\Models\User;
use App\Events\SeatStatusUpdated;

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
    protected $description = 'Refresh seats table';

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
            // 着席中の座席の確認
            if (!empty($seat->user)) {
                // ユーザーがオフラインの場合
                if (!$seat->user->isOnline()) {
                    // 累計着席時間の加算
                    if ($seat->role == 'study' || $seat->role == 'staff') {
                        $diff = Carbon::now()->diffInMinutes(new Carbon($seat->updated_at));
                        $seat->user->sitting_time += $diff;
                    }

                    // 座席の初期化
                    $seat->fill(['status' => null, 'reservation_user_id' => null])->save();
                    // ユーザーの退席処理
                    $seat->user->fill(['seat_id' => null])->save();

                    broadcast(new SeatStatusUpdated($seat->section->room_id));
                }
            }

            // 予約中の座席の確認
            if (!empty($seat->reservation_user_id)) {
                $reservation_user = User::find($seat->reservation_user_id);
                // ユーザーがオフラインの場合
                if (!$reservation_user->isOnline()) {
                    // 累計着席時間の加算
                    $diff = Carbon::now()->diffInMinutes(new Carbon($seat->updated_at));
                    $reservation_user->sitting_time += $diff;
                    $reservation_user->save();

                    // 座席の予約解除
                    $seat->fill(['status' => null, 'reservation_user_id' => null])->save();

                    broadcast(new SeatStatusUpdated($seat->section->room_id));
                }
            }
        }

        return 0;
    }
}
