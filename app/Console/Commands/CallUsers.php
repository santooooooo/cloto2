<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Abraham\TwitterOAuth\TwitterOAuth;

class CallUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'call';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call users via Twitter';

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
        $TWITTER_API_KEY = 'XHVcVVoXjlcKa67a9A6Un9kvi';
        $TWITTER_API_KEY_SECRET = 'QDAP1MDs8FAlvgXWaHtO1suup4HTGsSTkg3ewlSJuZXbdKhwKc';
        $TWITTER_ACCESS_TOKEN = "1263375628230782977-owh6ORwPXnJ6dPLzlKgEJK7fXtjvA1";
        $TWITTER_ACCESS_TOKEN_SECRET = '4MLfCuSIaIetxR4UAm1cwpYbhDuRmdUK6YcWmdsLQeD0L';

        $twitter = new TwitterOAuth($TWITTER_API_KEY, $TWITTER_API_KEY_SECRET, $TWITTER_ACCESS_TOKEN, $TWITTER_ACCESS_TOKEN_SECRET);
        $result = $twitter->post("statuses/update", array("status" => "TEST Tweet."));

        var_dump($result);

        return 0;
    }
}
