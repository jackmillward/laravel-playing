<?php

namespace App\Http\Controllers;

use App\Contracts\Services\SuggestionsServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetSuggestionsRequest;
use App\Http\Resources\SuggestionsResource;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class SuggestionsController extends Controller
{
    public function __construct(private SuggestionsServiceInterface $suggestionsService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function __invoke(GetSuggestionsRequest $request)
    {
        $participants = $request->get('participants', 1);
        $suggestion = $this->suggestionsService->getSuggestion($participants);

        return Inertia::render('Suggestions', [
            'suggestion' => $suggestion,
            'participantCount' => $participants,
        ]);
    }
}
