<?php

namespace App\Module\Blog\Resources\v1\User;

use App\Tools\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;

class Single extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'id' => $this->id,
        ];
    }

    public function with($request)
    {
        return ['status' => 'Success'];
    }
}
