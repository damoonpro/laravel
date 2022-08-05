<?php

use App\Http\Controllers\api\v1\Blog\Guest\Controller as GuestBlogController;
use Illuminate\Support\Facades\Route;

Route::prefix('blog')->controller(GuestBlogController::class)->group(function (){
    Route::get('/', 'collect'); // collect blogs by paginate 12 for guest users
    Route::get('filter', 'filter'); // collect blogs by paginate 12 for guest users
    Route::get('{blog:slug}', 'single'); // get single blog data

    Route::middleware('auth:sanctum')->group(function(){
        Route::post('{blog:slug}/like', 'like'); // like or dislike a blog when user authenticated
        Route::post('{blog:slug}/reply', 'reply'); // reply a blog or answer the reply when user authenticated 
    });
});
