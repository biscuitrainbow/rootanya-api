<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $view->with('telescopeScriptVariables', ['path' => 'rootanya/telescope', 'timezone' => config('app.timezone'), 'recording' => !cache('telescope:pause-recording'),]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
