<?php

namespace App\Http\Controllers\api\v1\Admin\Config\Message;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\v1\Admin\Config\Message\Update as UpdateMessageRequest;
use App\Http\Resources\v1\Admin\Config\Message\Collection as ConfiguredMessageCollection;
use Damoon\Tools\Helpers;
use Exception;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public function collect(){
        $configured_messages = config('app.notification_message');
        return new ConfiguredMessageCollection(collect($configured_messages));
    }

    public function update($alias, UpdateMessageRequest $request){
        $notification = $this->findNotification($alias);
        $notification->defaultConfig()->update([
            'text' => $request->text,
        ]);

        return Helpers::responseWithMessage('تنظیمات پیامک با موفقیت ویرایش یافت', [
            'sms' => [
                'label' => $notification->translate(),
            ]
        ]);
    }

    protected function findNotification($alias){
        $notifications = config('app.notification_message');

        if(isset($notifications[$alias]))
            return app($notifications[$alias]);

        throw new Exception('کانفیگ مورد نظر یافت نشد');
    }
}
