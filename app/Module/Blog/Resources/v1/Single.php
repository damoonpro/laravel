<?php

namespace App\Module\Blog\Resources\v1;

use App\Module\Blog\Resources\v1\Category\Collection as CategoryCollection;
use App\Module\Blog\Resources\v1\User\Single as SingleUserView;
use Illuminate\Http\Resources\Json\JsonResource;

class Single extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'body' => $this->body,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'confirmed' => $this->confirmed,
            'likes' => $this->likes()->count(),
            'user' => new SingleUserView($this->user),
            'categories' => new CategoryCollection($this->categories()->get()),
            // TODO : add view and reply
        ];
    }

    public function with($request)
    {
        return ['status' => 'Success'];
    }
}
