<?php

namespace App\Http\Controllers\api\v1\Authenticated\SMS;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\Mobile;
use App\Models\User;
use App\Notifications\v1\Login\SMS\Notify as LoginWithSmsNotify;
use Damoon\Tools\Helpers;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public function sendSMS(Mobile $request){
        $user = User::firstOrCreate(['mobile' => $request->mobile], [
            'name' => 'کاربر',
        ]);
        $activeCode = User\ActiveCode::generateForUser($user);

        $user->notify(new LoginWithSmsNotify($activeCode->code));

        return Helpers::responseWithMessage('پیامک با ورود با موفقیت برای شما ارسال شد', [
            'user' => [
                'mobile' => $user->mobile,
            ]
        ]);
    }
}
