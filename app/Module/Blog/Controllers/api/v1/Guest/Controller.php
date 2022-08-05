<?php

namespace App\Module\Blog\Controllers\api\v1\Guest;

use App\Http\Controllers\Controller as BaseController;
use App\Module\Blog\Resources\v1\Collection as BlogCollection;
use App\Module\Blog\Resources\v1\Single as SingleBlogView;
use App\Module\Blog\Requests\v1\Reply as ReplyBlogRequest;
use App\Module\Blog\Models\Blog;
use App\Tools\Helpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Controller extends BaseController
{
    public function collect(){
        return new BlogCollection(Blog::whereConfirmed(true)->latest()->paginate(12)); // TODO : add request to filter and sort blogs
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

    public function single(Blog $blog){
        if($blog->confirmed)
            return new SingleBlogView($blog);
        throw new NotFoundHttpException('صفحه یافت نشد');
    }

    public function like(Blog $blog){
        if($blog->likes()->whereUserId(auth()->user()->id)->first()){
            $blog->likes()->detach(['user_id' => auth()->user()->id]);

            return Helpers::responseWithMessage('لایک شما با موفقیت حذف شد', [
                'blog' => [
                    'slug' => $blog->slug
                ]
            ]);
        }
        $blog->likes()->attach(auth()->user()->id);

        return Helpers::responseWithMessage('لایک شما با موفقیت ثبت شد', [
            'blog' => [
                'slug' => $blog->slug
            ]
        ]);
    }

    public function reply(Blog $blog, ReplyBlogRequest $request){
        $reply = $blog->replies()->create([
            'text' => $request->text,
            'user_id' => auth()->user()->id,
            'parent_id' => $request->parent_id,
        ]);

        return Helpers::responseWithMessage('باز خورد شما با موفقیت ثبت شد',[
            'reply' => [
                'id' => $reply->id,
                'blog' => [
                    'slug' => $blog->slug
                ]
            ]
        ]);
    }
}
