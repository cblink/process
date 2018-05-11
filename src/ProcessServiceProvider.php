<?php


namespace Cblink\Process;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;


class ProcessServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->registerRoutes();
    }

    protected function registerRoutes()
    {
        Route::group([
            'namespace' => 'Cblink\Process\Http\Controllers',
            'middleware' => ['web', 'api'],
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        });
    }

}