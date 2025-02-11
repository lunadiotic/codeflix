<?php

namespace App\Listeners;

use App\Events\MembershipHasExpired;
use App\Notifications\MembershipExpiredNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMembershipExpiredNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MembershipHasExpired $event): void
    {
        $event->membership->user->notify(new MembershipExpiredNotification($event->membership));
    }
}
