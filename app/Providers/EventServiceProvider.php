<?php

namespace App\Providers;

use App\Listeners\LogConnectionFailed;
use App\Listeners\LogRequestSending;
use App\Listeners\LogResponseReceived;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Http\Client\Events\ConnectionFailed;
use Illuminate\Http\Client\Events\RequestSending;
use Illuminate\Http\Client\Events\ResponseReceived;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        RequestSending::class => [
            LogRequestSending::class
        ],
        ResponseReceived::class => [
            LogResponseReceived::class
        ],
        ConnectionFailed::class => [
            LogConnectionFailed::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
