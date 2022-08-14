<?php

namespace App\Http\Controllers\api\v1\Authenticated\SMS;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\Mobile;
use App\Http\Requests\v1\Authenticated\SMS\Verify as VerifyMobileRequest;
use App\Models\User;
use App\Models\User\ActiveCode;
use App\Notifications\v1\Login\SMS\Notify as LoginWithSmsNotify;
use Damoon\Tools\Helpers;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public function sendSMS(Mobile $request){
        $user = User::firstOrCreate(['mobile' => $request->mobile], [
            'name' => 'کاربر',
        ]);
        $activeCode = ActiveCode::generateForUser($user);

        $user->notify(new LoginWithSmsNotify($activeCode->code));

        return Helpers::responseWithMessage('پیامک با ورود با موفقیت برای شما ارسال شد', [
            'user' => [
                'mobile' => $user->mobile,
            ]
        ]);
    }

    public function verifySMS(VerifyMobileRequest $request){
        if($user = User::whereMobile($request->mobile)->first()){
            if(ActiveCode::checkCode($user, $request->code)){
                if(! $user->mobile_verified_at){
                    $user->update([
                        'mobile_verified_at' => now()
                    ]);
                }

                $token = $user->createToken('SMS')->plainTextToken;

                return $this->responseWithToken($token);
            }
        }

        return Helpers::responseWithMessage('ورود ناموفق',[
            'login' => [
                'message' => 'authentication failed !',
                'status' => 'error',
            ]
        ]);
    }

    protected function responseWithToken(string $token){
        return Helpers::responseWithMessage('احراز هویت موفقیت آمیز بود', [
            'token' => [
                'type' => 'bearer',
                'value' => $token,
            ]
        ]);
    }
}
