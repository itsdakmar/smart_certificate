<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendDirectorEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $programme_id;
    private $programme_name;
    private $sender;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->programme_id = $data['programme'];
        $this->programme_name = $data['programme_name'];
        $this->sender = $data['sender'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $programme_id = $this->programme_id;
        $programme_name = $this->programme_name;
        $sender = $this->sender;

        return $this->from('notify.ican@gmail.com')
            ->subject('I-CAn Notification')
            ->markdown('email.director', compact('programme_id','programme_name','sender'));
    }
}
