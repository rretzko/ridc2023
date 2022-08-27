<?php

namespace App\Mail;

use App\Models\Geostate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $input;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $input)
    {
        $this->input = $input;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Contact Form Submission')
            ->view('emails.sendContactForm',
                [
                    'inputs' => $this->input,
                    'state_descr' => Geostate::where('id', $this->input['geostate_id'])->first()->descr,
                ]);
    }
}
