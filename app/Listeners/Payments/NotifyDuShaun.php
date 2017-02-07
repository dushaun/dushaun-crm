<?php

namespace App\Listeners\Payments;

use App\Events\PaymentMade;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
     * @param  PaymentMade  $event
     * @return void
     */
    public function handle(PaymentMade $event)
    {
        //
    }
}
