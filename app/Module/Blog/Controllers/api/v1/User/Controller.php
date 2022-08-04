<?php

namespace App\Module\Blog\Controllers\api\v1\User;

use App\Http\Controllers\Controller as BaseController;
use App\Module\Blog\Requests\v1\Create as CreateBlogRequest;
use App\Tools\Helpers;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public function create(CreateBlogRequest $request){
        $blog = auth()->user()->blogs()->create([
            'title' => $request->title,
            'description' => $request->description,
            'body' => $request->body,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'confirmed' => false,
        ]);

        return Helpers::responseWithMessage('وبلاگ شما با موفقیت ثبت شد', [
            'blog' => [
                'slug' => $blog->slug,
                'confirmed' => $blog->confirmed,
            ]
        ]);
    }
}
