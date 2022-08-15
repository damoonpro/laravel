<?php

namespace App\Http\Resources\v1\Admin\Config\Message;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    public function __construct(protected $configured)
    {
        parent::__construct($configured);
    }

    public function toArray($request)
    {
        return $this->collection->map(function ($configured){
            $configured = app($configured);
            $current = $configured->defaultConfig();

            $model = [
                'alias' => $configured->alias(),
                'help' => $configured->help(),
                'text' => $current->text,
                'label' => $configured->translate(),
            ];

            return $model;
        });
    }

    public function with($request)
    {
        return ['status' => 'Success'];
    }
}
