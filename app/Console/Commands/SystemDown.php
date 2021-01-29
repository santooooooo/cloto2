<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use App\Events\SystemDowned;

class SystemDown extends Command
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
    protected $description = 'System down';

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
        // システム停止
        Artisan::call('down');
        // ユーザーへ通知
        broadcast(new SystemDowned());

        return 0;
    }
}
