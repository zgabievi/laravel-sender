<?php

return [

    /**
     * This value decides to log or not to log requests.
     */
    'debug' => env('SENDER_DEBUG', false),

    /**
     * This is the api key, which should be generated
     * by sender.ge tech stuff.
     */
    'api_key' => env('SENDER_API_KEY'),

    /**
     * This is the url provided by sender.ge developer.
     */
    'api_url' => env('SENDER_API_URL', 'https://sender.ge/api'),
];
