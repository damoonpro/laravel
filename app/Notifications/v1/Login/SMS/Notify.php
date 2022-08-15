<?php

namespace App\Notifications\v1\Login\SMS;

use App\Broadcasting\v1\Login\SMS\Channel as LoginWithSmsChannel;
use App\Interfaces\Message\IConfigured;
use App\Models\ConfigMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Notify extends Notification implements ShouldQueue, IConfigured
{
    use Queueable;
    public string $text;

    public function __construct(public int $code)
    {
        // TODO : get this message form database
        $this->text = '{user} عزیز کد ورود شما : {code} است';
    }

    public function via($notifiable)
    {
        return [LoginWithSmsChannel::class];
    }

    public function help(): string
    {
        return "برای اینکه بتوانید متن پیامک تایید ورود را تغییر دهید استفاده از
کلمه کلیدی : {code} اجباریست
کلمه کلیدی : {user} اختیاری

کلمه کلیدی {code} کد ارسالی به شماره مد نظر است.
کلمه کلیدی {user} نام کاربر است که درصورتی که بخواهید کاربر در هنگام دریافت پیامک نام خود را ببیند از این کلمه کلیدی باید استفاده کنید.

مثال :
{user} عزیز کد ورود شما به سایت {code} است

خروجی ( برای کاربر با نام 'ادمین' و کد 17935 )

ادمین عزیز کد ورود شما به سایت 17935 است.";
    }

    public function defaultConfig(): ConfigMessage
    {
        return ConfigMessage::firstOrCreate(['notification' => self::class], [
            'help' => $this->help(),
            'text' => $this->defaultText(),
            'alias' => $this->alias(),
        ]);
    }

    public function alias(): string
    {
        return 'login_sms';
    }

    public function translate(): string
    {
        return 'پیامک لاگین';
    }

    public function defaultText(): string
    {
        return  "{user} عزیز کد ورود شما به سایت {code} است";
    }
}
