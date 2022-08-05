<?php

namespace App\Module\Blog\Controllers\api\v1\Admin;

use App\Http\Controllers\Controller as BaseController;
use App\Module\Blog\Requests\v1\Admin\Filter as FilterBlogRequest;
use App\Models\User;
use App\Module\Blog\Resources\v1\Collection as BlogCollection;
use App\Module\Blog\Models\Blog;
use App\Tools\Helpers;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public function confirmed(Blog $blog){
        $blog->update([
            'confirmed' => ! $blog->confirmed
        ]);

        $messages = [
            'وبلاگ با موفقیت غیرفعال شد',
            'وبلاگ با موفقیت فعال شد',
        ];

        return Helpers::responseWithMessage($messages[$blog->confirmed], [
            'blog' => [
                'slug' => $blog->slug
            ]
        ]);
    }

    public function collect(){
        return new BlogCollection(Blog::paginate(12));
    }

    public function filter(FilterBlogRequest $request){
        // TODO : set other filter latter

        if($request->user){
            $blog = User::whereId($request->user)->first()->blogs()->paginate(12);
        }
        $blog = ! isset($blog) ? Blog::paginate(12) : $blog;

        return new BlogCollection($blog);
    }
}
