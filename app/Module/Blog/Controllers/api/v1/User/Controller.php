<?php

namespace App\Module\Blog\Controllers\api\v1\User;

use App\Http\Controllers\Controller as BaseController;
use App\Module\Blog\Requests\v1\Create as CreateBlogRequest;
use App\Module\Blog\Requests\v1\Update as UpdateBlogRequest;
use App\Module\Blog\Resources\v1\Collection as BlogCollection;
use App\Module\Blog\Resources\v1\Single as SingleBlogView;
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

    public function update($blog, UpdateBlogRequest $request)
    {
        $blog = auth()->user()->blogs()->whereSlug($blog)->firstOrFail(); // at the first blog is only string of slug then become to blog model

        $blog->update([
            'title' => $request->title ?? $blog->title,
            'description' => $request->description ?? $blog->description,
            'body' => $request->body ?? $blog->body,
            'meta_title' => $request->meta_title ?? $blog->meta_title,
            'meta_description' => $request->meta_description ?? $blog->meta_description,
        ]);

        return Helpers::responseWithMessage('ویرایش وبلاگ موفقیت آمیز بود', [
            'blog' => [
                'slug' => $blog->slug
            ]
        ]);
    }

    public function single($blog){
        $blog = auth()->user()->blogs()->whereSlug($blog)->firstOrFail(); // at the first blog is only string of slug then become to blog model

        return new SingleBlogView($blog);
    }

    public function collect(){
        return new BlogCollection(auth()->user()->blogs()->paginate(12));
    }
}
