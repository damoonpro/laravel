<?php

namespace App\Module\Blog\Resources\v1\Reply;;

use App\Module\Blog\Models\Reply;
use App\Tools\Helpers;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    // TODO : check if admin want to see replies the reply is confirmed or not to added or remove that
    public function toArray($request)
    {
        return $this->collection->map(function (Reply $reply){
            $children = $reply->replies()->get();
            $model = Helpers::arrayPure([
                'id' => $reply->id,
                'text' => $reply->text,
                'user' => [
                    'name' => $reply->user->name,
                    ],
                'replies' => $children->count() ? new self($children) : null
                ]);

            return $model;
        });
    }

    public function with($request)
    {
        return ['status' => 'Success'];
    }
}
