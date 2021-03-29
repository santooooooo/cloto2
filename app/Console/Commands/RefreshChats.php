<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Chat;

class RefreshChats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:chats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh chats table';

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
        // チャットデータを全件削除
        Chat::truncate();

        return 0;
    }
}
