<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'api_auth' => [
        'url' => env('API_AUTH_URL', 'http://localhost:8001') . '/api',
    ],

    'api_historial' => [
        'url'   => env('API_HISTORY_URL', 'http://localhost:8003'),
        'token' => env('API_HISTORY_TOKEN', null),
    ],

];
