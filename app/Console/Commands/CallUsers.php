<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

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
        $twitter = new TwitterOAuth(
            config('external.twitter.api_key'),
            config('external.twitter.api_key_secret'),
            config('external.twitter.access_token'),
            config('external.twitter.access_token_secret')
        );

        foreach (User::all() as $user) {
            if (!Cache::has('user-' . $user->id . '-login')) {
                if (!empty($user->sns) && isset($user->sns['twitter'])) {
                    $text = '.@' . $user->sns['twitter'] . ' さん\n\n';
                    $text .= '昨日は着席がありませんでした😭😭😭\n\n';
                    $text .= '今日は頑張りましょう💪\n\n';
                    $text .= config('app.url');

                    $tweet = str_replace('\\n', PHP_EOL, $text);
                    $twitter->post('statuses/update', ['status' => $tweet]);
                }
            }
        }

        return 0;
    }
}
