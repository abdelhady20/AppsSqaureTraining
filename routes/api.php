<?php

use App\Http\Controllers\Api\Front\BannerController;
use App\Http\Controllers\Api\Front\OrderController;
use App\Services\Notification\PushNotificationService;
use Illuminate\Support\Facades\Route;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\{Driver};

/*
|--------------------------------------------------------------------------
| API Authentication Routes
|--------------------------------------------------------------------------
*/


//User
Route::controller('AuthController')->group(function () {
    Route::post('auth/register', 'register');
    Route::post('auth/verify', 'verify');
    Route::post('auth/send-code', 'sendCode');    //Send_Code , SENDCODE , sendcode, SendCode
    Route::post('auth/verify-code', 'verifyCode');
});

// Banner
Route::controller(BannerController::class)->group(function () {
    Route::post('banners', 'store');
    Route::put('banners/{id}', 'update');
    Route::delete('banners/{id}', 'destroy');
});
