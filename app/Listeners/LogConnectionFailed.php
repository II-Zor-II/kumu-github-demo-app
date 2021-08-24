<?php


namespace App\Listeners;


use Illuminate\Http\Client\Events\ConnectionFailed;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Log;

class LogConnectionFailed
{
    public function handle(ConnectionFailed $event)
    {
        /**
         * @var Request $request
         */
        $request = $event->request;

        Log::error("3rd party API connection failed.", [
            'url' => $request->url(),
            'method' => $request->method(),
            'headers' => $request->headers(),
            'body' => $request->body(),
            'data' => $request->data()
        ]);

    }
}
