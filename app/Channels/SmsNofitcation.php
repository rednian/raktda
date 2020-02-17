<?php
namespace app\Channels;

use Illuminate\Notifications\Notification;


class SmsNotification{

    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSms($notifiable);
        // sendSms('+971569266233', 'Test message.');
    }
}
