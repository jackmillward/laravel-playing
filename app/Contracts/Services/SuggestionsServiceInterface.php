<?php

namespace App\Contracts\Services;

interface SuggestionsServiceInterface
{
    public function getSuggestion(int $participants = 1);
}
