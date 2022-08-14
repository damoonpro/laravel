<?php

namespace App\Notifications\v1\Login\SMS;

use App\Broadcasting\v1\Login\SMS\Channel as LoginWithSmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Notify extends Notification implements ShouldQueue
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
}
