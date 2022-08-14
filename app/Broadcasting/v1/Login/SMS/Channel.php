<?php

namespace App\Broadcasting\v1\Login\SMS;

use App\Models\KavenegarSMS;
use App\Models\User;
use Illuminate\Notifications\Notification;
use Kavenegar\KavenegarApi;

class Channel
{

    public function send($notifiable, Notification $notification)
    {
        if ($notifiable->mobile && $notification->text) {
            $params = [
                '{code}',
                '{user}',
                ];

            $replace = [
                $notification->code,
                $notifiable->name ?? 'کاربر'
            ];

            $text = str_replace($params, $replace, $notification->text);

            $localId = KavenegarSMS::codeGenerator();

            $sender = env('KAVENEGAR_SENDER_NUMBER');
            $apiKey = env('KAVENEGAR_API_KEY');
            $api = new KavenegarApi($apiKey);
            $sms = $api->Send($sender, $notifiable->mobile, $text, localid: $localId);

            if ($sms) {
                $sms = $sms[0];

                KavenegarSMS::create([
                    'user_id' => $notifiable->id,
                    'message_id' => $sms->messageid,
                    'local_id' => $localId,
                    'message' => $sms->message,
                    'status' => $sms->status,
                    'status_text' => $sms->statustext,
                    'from' => $sms->sender,
                    'to' => $sms->receptor,
                    'price' => $sms->cost,
                    'send_at' => now()->timezone('UTC')->timestamp($sms->date)
                ]);
            }
        }
    }
}
