<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Support;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use SandwaveIo\RealtimeRegister\Exceptions\NotFoundException;
use SandwaveIo\RealtimeRegister\Exceptions\RealtimeRegisterClientException;

class AuthorizedClient
{
    /** @var string */
    private $apiKey;

    /** @var Client */
    private $client;

    /** @var LoggerInterface|null */
    private $logger;


    public function __construct(string $baseUrl, string $apiKey, array $guzzleOptions = [], ?LoggerInterface $logger = null)
    {
        $this->apiKey = $apiKey;
        $this->logger = $logger;

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
        // Build request options.
        $metaData = [
            'headers' => [
                'Authorization' => 'ApiKey ' . $this->apiKey,
            ],
            'http_errors' => false,
        ];

        if ($body !== []) {
            $metaData['json'] = $body;
        }

        // Log request.
        $logContext = [
            'meta_data' => $metaData,
            'method' => $method,
            'endpoint' => $endpoint . $this->buildQuery($query),
            'body' => $body,
            'expected_response' => $expectedResponse ?? 'NOT SET',
        ];
        $logContext['meta_data']['headers']['Authorization'] = 'ApiKey masked-api-key';
        $this->log(
            sprintf(
                'RealtimeRegister.REQUEST: %s %s',
                strtoupper($method),
                $endpoint . $this->buildQuery($query)
            ),
            $logContext
        );

        // Send request.
        $response = $this->client->request($method, $endpoint . $this->buildQuery($query), $metaData);

        return $this->handleResponse($response, $expectedResponse);
    }

    private function handleResponse(ResponseInterface $response, ?int $expectedResponse = null): RealtimeRegisterResponse
    {
        // Log response
        $this->log(
            sprintf(
                'RealtimeRegister.RESPONSE: %s - BODY: %s',
                $response->getStatusCode(),
                (string) $response->getBody()
            ),
            [
                'response_code' => $response->getStatusCode(),
                'response_body' => (string) $response->getBody(),
                'expected_response' => $expectedResponse ?? 'NOT SET',
                'headers' => $response->getHeaders(),
            ]
        );

        // Parse response
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

    private function log(string $message, array $context = []): void
    {
        if ($this->logger instanceof LoggerInterface) {
            $this->logger->debug($message, $context);
        }
    }
}
