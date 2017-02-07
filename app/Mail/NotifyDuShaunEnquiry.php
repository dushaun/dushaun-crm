<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyDuShaunEnquiry extends Mailable
{
    public $enquiry;
    public $product;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param $enquiry
     * @param $product
     */
    public function __construct($enquiry, $product)
    {
        $this->enquiry = $enquiry;
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.notify_dushaun_enquiry');
    }
}
