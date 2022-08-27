<?php

namespace App\Listeners;

use App\Events\SendContactFormEvent;
use App\Mail\SendContactFormMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendContactFormListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(SendContactFormEvent $event)
    {
       Mail::to('rick@mfrholdings.com')
           ->send(new SendContactFormMail($event->input));
    }
}
