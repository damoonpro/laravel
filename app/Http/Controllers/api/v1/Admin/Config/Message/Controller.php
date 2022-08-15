<?php

namespace App\Http\Controllers\api\v1\Admin\Config\Message;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Resources\v1\Admin\Config\Message\Collection as ConfiguredMessageCollection;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public function collect(){
        $configured_messages = config('app.notification_message');
        return new ConfiguredMessageCollection(collect($configured_messages));
    }
}
