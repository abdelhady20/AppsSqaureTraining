<?php

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

Route::controller('AuthController')->group(function () {
    Route::post('auth/register', 'register');
    Route::post('auth/verify', 'verify');
    Route::post('auth/send-code', 'sendCode');    //Send_Code , SENDCODE , sendcode, SendCode
    Route::post('auth/verify-code', 'verifyCode');
});
