<?php

namespace App\Module\Blog\Controllers\api\v1\Guest;

use App\Http\Controllers\Controller as BaseController;
use App\Module\Blog\Resources\v1\Collection as BlogCollection;
use App\Module\Blog\Models\Blog;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public function collect(){
        return new BlogCollection(Blog::whereConfirmed(true)->paginate(12)); // TODO : add request to filter and sort blogs
    }
}
