<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\SystemDown;

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
        // システム停止イベントの発行
        broadcast(new SystemDown());

        return 0;
    }
}
