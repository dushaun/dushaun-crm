<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnquiryConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $enquiry;

    /**
     * Create a new message instance.
     *
     * @param $enquiry
     */
    public function __construct($enquiry)
    {
        $this->enquiry = $enquiry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.enquiry_confirmation');
    }
}
