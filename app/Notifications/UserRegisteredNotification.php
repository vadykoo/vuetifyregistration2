<?php

namespace App\Notifications;

use App\Channels\SMSChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRegisteredNotification extends Notification
{
    use Queueable;

    public function via()
    {
        return [
            SMSChannel::class,
            //'mail' // 'mail' as a notification channel can be used
        ];
    }

    public function toSMS()
    {
        return 'Welcome to our application! Thank you for registering.';
    }

    public function toMail()
    {
        return (new MailMessage)
            ->subject('Welcome to Our Application')
            ->line('Welcome to our application! Thank you for registering.');
    }
}
