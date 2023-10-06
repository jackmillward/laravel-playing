<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\SuggestionsServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetSuggestionsRequest;
use App\Http\Resources\SuggestionsResource;
use Symfony\Component\HttpFoundation\Response;

class SuggestionsController extends Controller
{
    public function __construct(private SuggestionsServiceInterface $suggestionsService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function fetch(GetSuggestionsRequest $request)
    {
        $suggestion = $this->suggestionsService->getSuggestion($request->get('participants', 1));

        if (!$suggestion) {
            return response()->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new SuggestionsResource($suggestion);
    }
}
