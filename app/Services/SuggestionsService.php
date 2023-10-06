<?php

namespace App\Services;

use App\Contracts\Services\SuggestionsServiceInterface;
use App\Managers\SuggestionsManager;
use Illuminate\Support\Collection;

class SuggestionsService implements SuggestionsServiceInterface
{

    public function getSuggestion(int $participants = 1): ?Collection
    {
        try {
            return app(SuggestionsManager::class)->fetchActivity($participants);
        } catch (\Exception $exception) {
            report($exception);
            return null;
        }
    }
}
