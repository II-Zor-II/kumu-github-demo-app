<?php


namespace App\Listeners;


use Illuminate\Http\Client\Events\ResponseReceived;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;

class LogResponseReceived
{
    public function handle(ResponseReceived $event)
    {
        /**
         * @var Response $response
         */
        $response = $event->response;

        /**
         * Log only failed response
         */
        if ($response->failed() || $response->clientError() || $response->serverError()) {
            Log::error("3rd party API response error.", [
                'url' => $event->request->url(),
                'headers' => $response->headers(),
                'body' => $response->body()
            ]);
        }

    }
}
