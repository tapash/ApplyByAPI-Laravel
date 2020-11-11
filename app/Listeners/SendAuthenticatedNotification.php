<?php

namespace App\Listeners;

use App\Notifications\UserAuthenticated;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAuthenticatedNotification
{
    /**
     * Handle the event.
     *
     * @param  Authenticated  $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        $event->user->notify(
            new UserAuthenticated()
        );
    }
}
