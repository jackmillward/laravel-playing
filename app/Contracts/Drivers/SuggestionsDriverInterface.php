<?php

namespace App\Contracts\Drivers;

interface SuggestionsDriverInterface
{
    public function getDriverUrl(): string;

    public function fetchActivity(int $participants);
}
