<?php

return [
  // twitter api key
  'twitter' => [
    'api_key' => env('TWITTER_API_KEY', ''),
    'api_key_secret' => env('TWITTER_API_KEY_SECRET', ''),
    'access_token' => env('TWITTER_API_ACCESS_TOKEN', ''),
    'access_token_secret' => env('TWITTER_API_ACCESS_TOKEN_SECRET', ''),
    'bearer_token' => env('TWITTER_BEARER_TOKEN', ''),
    'callback_url' => env('TWITTER_CLIENT_CALLBACK', ''),
  ],
];
