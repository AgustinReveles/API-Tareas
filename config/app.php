<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name & Environment
    |--------------------------------------------------------------------------
    */
    'name'              => env('APP_NAME', 'Laravel'),
    'env'               => env('APP_ENV', 'production'),
    'debug'             => (bool) env('APP_DEBUG', false),
    'url'               => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Timezone & Locale
    |--------------------------------------------------------------------------
    */
    'timezone'          => 'UTC',
    'locale'            => env('APP_LOCALE', 'en'),
    'fallback_locale'   => env('APP_FALLBACK_LOCALE', 'en'),
    'faker_locale'      => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    */
    'key'               => env('APP_KEY'),
    'cipher'            => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    */
    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Routing\RoutingServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    */
    'aliases' => [
        'App'        => Illuminate\Support\Facades\App::class,
        'Auth'       => Illuminate\Support\Facades\Auth::class,
        'Cache'      => Illuminate\Support\Facades\Cache::class,
        'Config'     => Illuminate\Support\Facades\Config::class,
        'DB'         => Illuminate\Support\Facades\DB::class,
        'Hash'       => Illuminate\Support\Facades\Hash::class,
        'Route'      => Illuminate\Support\Facades\Route::class,
        'Schema'     => Illuminate\Support\Facades\Schema::class,
        'Session'    => Illuminate\Support\Facades\Session::class,
        'Cookie'     => Illuminate\Support\Facades\Cookie::class,
        'Validator'  => Illuminate\Support\Facades\Validator::class,
        'View'       => Illuminate\Support\Facades\View::class,
    ],

];
