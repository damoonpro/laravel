<?php

use App\Module\Blog\Controllers\api\v1\Admin\Controller as BlogAdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('blog')->controller(BlogAdminController::class)->group(function(){
    Route::post('{blog:slug}/confirmed', 'confirmed');
});
