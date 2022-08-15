<?php

use App\Http\Controllers\api\v1\Admin\Config\Message\Controller as AdminSmsConfigController;
use App\Http\Controllers\api\v1\Authenticated\SMS\Controller as SmsController;
use Damoon\Tools\Custom\Route\Route;

Route::get('/', function (){
    return "Description : Since August 02, 2020, we have come together to \"live with awareness and collective effort\" to walk for each other on the path of progress, embracing \"freedom and responsibility\".

    website : https://damoon.pro/
    github : https://github.com/damoonpro";
});

// route login goes here to other code page goes clean
Route::prefix('v1')->group(function (){

    Route::prefix('login')->group(function (){

        Route::prefix('SMS')->controller(SmsController::class)->group(function (){
            Route::post('/', 'sendSMS')->middleware('throttle:1,2'); // route-url : v1/login/SMS => POST { mobile }
            Route::post('verify', 'verifySMS')->middleware('throttle:3,2'); // route-url : v1/login/SMS/verify => POST { mobile, code }
        });
    });

    Route::prefix('admin/config')->group(function (){
        Route::prefix('message')->group(function (){
            Route::get('/', [AdminSmsConfigController::class, 'collect']);
        });
    });
});
