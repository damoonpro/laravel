<?php

namespace App\Module\Blog\Resources\v1;

use App\Module\Blog\Resources\v1\Category as CategoryCollection;
use App\Module\Blog\Resources\v1\User as SingleUserView;
use App\Module\Blog\Models\Blog;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function (Blog $blog){
            $model = [
                'user' => new SingleUserView($blog->user),
                'categories' => new CategoryCollection($blog->categories()->get()),
                'title' => $blog->title,
                'slug' => $blog->slug,
                'description' => $blog->description,
                'meta_title' => $blog->meta_title,
                'meta_description' => $blog->meta_description,
                'confirmed' => $blog->confirmed, // when guest user ask to get data it always true but for owner and admin we need this field
            ];

            return $model;
        });
    }

    public function with($request)
    {
        return ['status' => 'Success'];
    }
}
