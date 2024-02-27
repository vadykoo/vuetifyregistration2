<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Notifications\UserRegisteredNotification;

class RegisteredListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $event->user->phone = $event->user->phone->number;

        $event->user->notify(new UserRegisteredNotification());
    }
}
