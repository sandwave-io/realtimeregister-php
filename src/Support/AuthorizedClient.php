<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Support;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use SandwaveIo\RealtimeRegister\Exceptions\NotFoundException;
use SandwaveIo\RealtimeRegister\Exceptions\RealtimeRegisterClientException;

class AuthorizedClient
{
    /** @var string */
    private $apiKey;

    /** @var Client */
    private $client;

    public function __construct(string $baseUrl, string $apiKey, array $guzzleOptions = [])
    {
        $this->apiKey = $apiKey;

        $this->client = new Client(array_merge($guzzleOptions, [
            'base_uri' => $baseUrl,
        ]));
    }

    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    public function get(string $endpoint, array $query = [], ?int $expectedResponse = null): RealtimeRegisterResponse
    {
        return $this->request('GET', $endpoint, [], $query, $expectedResponse);
    }

    public function post(string $endpoint, array $body = [], array $query = [], ?int $expectedResponse = null): RealtimeRegisterResponse
    {
        return $this->request('POST', $endpoint, $body, $query, $expectedResponse);
    }

    public function put(string $endpoint, array $body = [], array $query = [], ?int $expectedResponse = null): RealtimeRegisterResponse
    {
        return $this->request('PUT', $endpoint, $body, $query, $expectedResponse);
    }

    public function delete(string $endpoint, array $query = [], ?int $expectedResponse = null): RealtimeRegisterResponse
    {
        return $this->request('DELETE', $endpoint, [], $query, $expectedResponse);
    }

    private function request(string $method, string $endpoint, array $body = [], array $query = [], ?int $expectedResponse = null): RealtimeRegisterResponse
    {
        $metaData = [
            'headers' => [
                'Authorization' => 'ApiKey ' . $this->apiKey,
            ],
            'http_errors' => false,
        ];

        if ($body !== []) {
            $metaData['json'] = $body;
        }

        $response = $this->client->request($method, $endpoint . $this->buildQuery($query), $metaData);

        return $this->handleResponse($response, $expectedResponse);
    }

    private function handleResponse(ResponseInterface $response, ?int $expectedResponse = null): RealtimeRegisterResponse
    {
        if ($this->isResponseValid($response, $expectedResponse)) {
            return RealtimeRegisterResponse::fromString((string) $response->getBody());
        } elseif ($response->getStatusCode() === 404) {
            throw new NotFoundException('Not found.');
        }
        throw new RealtimeRegisterClientException("Unexpected response (got {$response->getStatusCode()}, expected {$expectedResponse}). Body: " . $response->getBody());
    }

    private function buildQuery(array $parameters): string
    {
        return ($parameters === []) ? '' : ('?' . http_build_query($parameters));
    }

    private function isResponseValid(ResponseInterface $response, ?int $expectedResponse): bool
    {
        if (is_int($expectedResponse)) {
            return $response->getStatusCode() === $expectedResponse;
        }
        return $response->getStatusCode() >= 200 && $response->getStatusCode() < 300;
    }
}
