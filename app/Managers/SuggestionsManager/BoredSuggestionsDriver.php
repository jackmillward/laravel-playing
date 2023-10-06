<?php

namespace App\Managers\SuggestionsManager;

use App\Contracts\Drivers\SuggestionsDriverInterface;
use App\Exceptions\DriverException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BoredSuggestionsDriver implements SuggestionsDriverInterface
{
    protected string $url;

    /**
     * @throws DriverException
     */
    public function __construct()
    {
        $this->url = config('suggestions.drivers.bored.url');

        if (!$this->url) {
            throw new DriverException('The BORED_API_URL value is not set.');
        }
    }

    public function getDriverUrl(): string
    {
        return $this->url;
    }

    private function onError(string $message)
    {
        throw new DriverException($message);
    }

    /**
     * @throws DriverException
     */
    public function fetchActivity(int $participants): \Illuminate\Support\Collection
    {
        $response = Http::get("{$this->getDriverUrl()}/activity", [
            'participants' => $participants,
        ]);

        if ($response->failed()) {
            Log::error("Request to Bored API failed", compact($response));

            $this->onError("Request to Bored API failed.");
        }

        $response = collect($response->json());

        if ($response->has('error')) {
            $this->onError("API error: \"".$response->get('error')."\"");
        }

        return $response;
    }
}
