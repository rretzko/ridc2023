<?php

namespace App\Mail;

use App\Models\CurrentEvent;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminEventInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $event = CurrentEvent::currentEvent();

        $sent = $this->subject($event->subtitle.' '.$event->title)
            ->view('admin.mails.invitation',
            [
                'user' => $this->user,
                'event' => CurrentEvent::currentEvent()
            ]
        );

        return $sent;
    }
}
