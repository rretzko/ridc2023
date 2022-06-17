<?php

namespace App\Listeners;

use App\Events\AdminInvitationEvent;
use App\Mail\AdminEventInvitationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class AdminInvitationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\AdminInvitationEvent  $event
     * @return void
     */
    public function handle(AdminInvitationEvent $event)
    {
        $mail = Mail::to('rick@mfrholdings.com')
            ->send(new AdminEventInvitationMail($event->user));
    }
}
