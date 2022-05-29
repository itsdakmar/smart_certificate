<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailConvertFailed extends Mailable
{
    use Queueable, SerializesModels;

    private $reason;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->reason = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->reason;

        return $this->from('notify@ican.my')
            ->subject('I-CAn Notification')
            ->markdown('email.failed', compact('data'));
    }
}
