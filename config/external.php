<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API keys of external services
    |--------------------------------------------------------------------------
    |
    | 外部サービスのAPIキー
    |
    */

    'twitter' => [
        'api_key' => env('TWITTER_API_KEY', 'Example'),
        'api_key_secret' => env('TWITTER_API_KEY_SECRET', 'Example'),
        'access_token' => env('TWITTER_ACCESS_TOKEN', 'Example'),
        'access_token_secret' => env('TWITTER_ACCESS_TOKEN_SECRET', 'Example'),
    ],

];
