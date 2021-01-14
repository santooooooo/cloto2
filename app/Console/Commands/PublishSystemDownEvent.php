<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Events\SystemDownEvent;

class PublishSystemDownEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:down';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish system down event';

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
        $users = User::all();

        // オンライン状態の全ユーザーに通知
        foreach ($users as $user) {
            if ($user->isOnline()) {
                broadcast(new SystemDownEvent($user));
            }
        }

        return 0;
    }
}
