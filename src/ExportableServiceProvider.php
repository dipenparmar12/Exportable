<?php

namespace Dipenparmar12\Exportable;

use Dipenparmar12\Exportable\Commands\CsvExport;
use Illuminate\Support\ServiceProvider;

class ExportableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . "/routes/web.php");
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CsvExport::class
            ]);
        }

//        $this->commands([
//            csvExport::class
//        ]);

//        $this->app->singleton('command.dipenparmar12.csv:export', function($app) {
//            return $app['Dipenparmar12\Console\Commands\csvExport'];
//        });
//
    }
}
