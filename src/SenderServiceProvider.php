<?php

namespace Zorb\Sender;

use Illuminate\Support\ServiceProvider;

class SenderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__ . '/config/sender.php' => config_path('sender.php'),
        ], 'config');

        $this->mergeConfigFrom(__DIR__ . '/config/sender.php', 'sender');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(Sender::class);
    }
}
