<?php

namespace App\Listeners\Enquiries;

use App\Events\EnquirySubmitted;
use App\Mail\EnquiryConfirmation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class EmailSubmitter
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
     * @param  EnquirySubmitted  $event
     * @return void
     */
    public function handle(EnquirySubmitted $event)
    {
        $confirmation = new EnquiryConfirmation($event);
        Mail::to($event->email)->send($confirmation);
    }
}
