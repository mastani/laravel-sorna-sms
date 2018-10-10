<?php

namespace mastani\SornaSMS;

use Illuminate\Support\ServiceProvider;

class SornaSMSServiceProvider extends ServiceProvider {
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        $this->publishes([
            __DIR__.'/config/sornasms.php' => config_path('sornasms.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton(SornaSMS::class, function () {
            return new SornaSMS();
        });

        $this->app->alias(SornaSMS::class, 'sorna-sms');

        $this->mergeConfigFrom(
            __DIR__ . '/config/sornasms.php', 'sornasms'
        );
    }
}