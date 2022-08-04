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

    // TODO : I think this part can be better than what is it.
    public function filter(Request $request){
        $blogs = Blog::whereConfirmed(true);

        if($request->filter === 'like')
            $blogs = $blogs->withCount('likes')->orderBy('likes_count', 'desc');
        elseif($request->filter === 'old')
            $blogs = $blogs->orderBy('created_at');
        else
            $blogs = $blogs->latest();

        return new BlogCollection($blogs->paginate(12));
    }
}
