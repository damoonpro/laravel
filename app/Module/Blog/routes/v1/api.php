<?php

use App\Http\Controllers\api\v1\Blog\Guest\Controller as GuestBlogController;

Route::prefix('blog')->controller(GuestBlogController::class)->group(function (){
    Route::get('/', 'collect'); // collect blogs by paginate 12 for guest users
    Route::get('filter', 'filter'); // collect blogs by paginate 12 for guest users
    Route::get('{blog:slug}', 'single'); // get single blog data
    Route::post('{blog:slug}/like', 'like')->middleware('auth:sanctum'); // like the blog by authenticated user
});
