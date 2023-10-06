<?php

namespace App\Managers;

use App\Managers\SuggestionsManager\BoredSuggestionsDriver;
use Illuminate\Support\Manager;

class SuggestionsManager extends Manager
{

    public function createBoredDriver()
    {
        return new BoredSuggestionsDriver();
    }

    /**
     * @inheritDoc
     */
    public function getDefaultDriver()
    {
        return config('suggestions.driver');
    }
}
