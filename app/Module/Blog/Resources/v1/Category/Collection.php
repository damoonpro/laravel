<?php

namespace App\Module\Blog\Resources\v1\Category;

use App\Module\Blog\Models\Bcategory;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function (Bcategory $bcategory){
            $model = [
                'label' => $bcategory->label,
                'slug' => $bcategory->slug,
            ];

            return $model;
        });
    }

    public function with($request)
    {
        return ['status' => 'Success'];
    }
}
