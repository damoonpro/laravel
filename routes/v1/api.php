<?php

use App\Http\Controllers\api\v1\Blog\Guest\Controller as BlogController;
use Illuminate\Support\Facades\Route;

Route::prefix('blog')->controller(BlogController::class)->group(function (){
    Route::get('/', 'collect'); // collect blogs by paginate 12 for guest users
});
