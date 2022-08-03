<?php

Route::prefix('blog')->controller(BlogController::class)->group(function (){
    Route::get('/', 'collect'); // collect blogs by paginate 12 for guest users
});
