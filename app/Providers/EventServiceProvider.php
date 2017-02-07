<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\EnquirySubmitted' => [
            'App\Listeners\Enquiries\NotifyDuShaun',
            'App\Listeners\Enquiries\EmailSubmitter'
        ],
        'App\Events\PaymentMade' => [
            'App\Listeners\Payments\EmailPayer',
            'App\Listeners\Payments\NotifyDuShaun'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
