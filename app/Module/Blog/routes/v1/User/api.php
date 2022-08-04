<?php

use App\Module\Blog\Controllers\api\v1\User\Controller as BlogUserController;

// It is important to user routes on 'me' group to using 'auth:sanctum' middleware
Route::prefix('me')->group(function (){
    Route::prefix('blog')->controller(BlogUserController::class)->group(function (){
        Route::get('/', 'collect');
        Route::post('create', 'create');
        Route::get('{slug}', 'single');
        Route::put('{slug}/update', 'update');
    });
});
