<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Managers\SuggestionsManager;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Http;
use Mockery;
use Mockery\MockInterface;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SuggestionsEndpointTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $data = [
            "activity" => "Learn how to fold a paper crane",
            "accessibility" => 0.05,
            "type" => "education",
            "participants" => 1,
            "price" => 0.1,
            "key" => "3136036",
        ];

        $this->instance(
            SuggestionsManager::class,
            Mockery::mock(SuggestionsManager::class, function (MockInterface $mock) use ($data) {
                $mock
                    ->shouldReceive('fetchActivity')
                    ->once()
                    ->andReturn(collect($data));
            })
        );

        $response = $this->call('GET', route('api.suggestions.get'), []);

        $response->assertStatus(Response::HTTP_OK);

        $json = $response->json()['data'];
        $this->assertEquals($data['activity'], $json['activity']);
    }

    public function test_the_application_returns_a_successful_response_when_participants_is_greater_than_1(): void
    {
        $data = [
            "activity" => "Learn how to fold a paper crane",
            "accessibility" => 0.05,
            "type" => "education",
            "participants" => 1,
            "price" => 0.1,
            "key" => "3136036",
        ];

        $this->instance(
            SuggestionsManager::class,
            Mockery::mock(SuggestionsManager::class, function (MockInterface $mock) use ($data) {
                $mock
                    ->shouldReceive('fetchActivity')
                    ->once()
                    ->andReturn(collect($data));
            })
        );

        $response = $this->call('GET', route('api.suggestions.get'), [
            'participants' => 2,
        ]);

        $response->assertStatus(Response::HTTP_OK);

        $json = $response->json()['data'];
        $this->assertEquals($data['activity'], $json['activity']);
    }

    public function test_the_application_returns_a_validation_response_when_participants_is_not_a_valid_number(): void
    {
        $response = $this->call('GET', route('api.suggestions.get'), [
            'participants' => 'notanumber',
        ]);

        $response->assertInvalid('participants');
    }

    public function test_the_application_returns_an_error_response_when_external_api_is_down(): void
    {
        Http::shouldReceive('get')
            ->andThrow(\Exception::class, 'API down!');

        $response = $this->call('GET', route('api.suggestions.get'), []);

        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
