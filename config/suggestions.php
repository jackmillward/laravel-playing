<?php
return [
    'driver' => env('SUGGESTIONS_DRIVER', 'bored'),
    'drivers' => [
        'bored' => [
            'url' => env('BORED_API_URL'),
        ]
    ],
];
