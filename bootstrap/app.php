<?php

use App\Console\Commands\AutoCancelOrder;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Console\Scheduling\Schedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            $namespace = 'App\Http\Controllers';
            Route::namespace($namespace . '\\Api\Front')->prefix('api')->middleware('api')->group(base_path('routes/api.php'));
//            Route::namespace($namespace . '\\Api\Admin')->prefix('api/admin')->middleware('api')->group(base_path('routes/admin.php'));
//            Route::namespace($namespace . '\\Api\Driver')->prefix('api/driver')->middleware('api')->group(base_path('routes/driver.php'));
//            Route::namespace($namespace . '\\Api\CallCenter')->prefix('api/call-center')->middleware('api')->group(base_path('routes/call_center.php'));
//            Route::namespace($namespace . '\\Api\DeliveryAdmin')->prefix('api/delivery-admin')->middleware('api')->group(base_path('routes/delivery_admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'api_key' => \App\Http\Middleware\CheckApiKeyOrAuth::class,
            'header' => \App\Http\Middleware\Header::class,
            'driver_header' => \App\Http\Middleware\DriverHeader::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('orders:cancel')->everyMinute();
        $schedule->command('samsa:delivered')->dailyAt('00:00');
    })
    ->create();
