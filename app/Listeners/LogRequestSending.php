<?php


namespace App\Listeners;

use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Events\RequestSending;
use Illuminate\Support\Facades\Log;

class LogRequestSending
{
    public function handle(RequestSending $event)
    {
        /**
         * @var Request $request
         */
        $request = $event->request;

        Log::debug("3rd party API request sent.", [
            'url' => $request->url(),
            'method' => $request->method(),
            'headers' => $request->headers(),
            'body' => $request->body(),
            'data' => $request->data()
        ]);

    }
}
