<?php

namespace App\Listeners\Enquiries;

use App\Events\EnquirySubmitted;
use App\Mail\NotifyDuShaunEnquiry;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NotifyDuShaun
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
        $confirmation = new NotifyDuShaunEnquiry($event);
        Mail::to('dushaun.ac@gmail.com')->send($confirmation);
    }
}
