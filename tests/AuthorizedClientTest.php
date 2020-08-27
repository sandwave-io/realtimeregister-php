<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use SandwaveIo\RealtimeRegister\Exceptions\NotFoundException;
use SandwaveIo\RealtimeRegister\Exceptions\RealtimeRegisterClientException;
use SandwaveIo\RealtimeRegister\Support\AuthorizedClient;

/** @covers \SandwaveIo\RealtimeRegister\Support\AuthorizedClient */
class AuthorizedClientTest extends TestCase
{
    public function test_construct(): void
    {
        $client = new AuthorizedClient('https://example.com/api/v2/', 'bigseretdonttellanyone');
        $this->assertInstanceOf(AuthorizedClient::class, $client);
    }

    public function requestVariants(): array
    {
        return [
            'GET request: success'  => ['get', 200, null],
            'GET request: not found'  => ['get', 404, NotFoundException::class],
            'GET request: error'  => ['get', 500, RealtimeRegisterClientException::class],
            'POST request: success'  => ['post', 201, null],
            'POST request: not found'  => ['post', 404, NotFoundException::class],
            'POST request: error'  => ['post', 500, RealtimeRegisterClientException::class],
            'PUT request: success'  => ['put', 200, null],
            'PUT request: not found'  => ['put', 404, NotFoundException::class],
            'PUT request: error'  => ['put', 500, RealtimeRegisterClientException::class],
            'DELETE request: success'  => ['delete', 200, null],
            'DELETE request: not found'  => ['delete', 404, NotFoundException::class],
            'DELETE request: error'  => ['delete', 500, RealtimeRegisterClientException::class],
        ];
    }

    /** @dataProvider requestVariants */
    public function test_http_methods(string $method, int $response, ?string $exception): void
    {
        $client = $this->getMockedClient($response, '', function (RequestInterface $request) use ($method) {
            $this->assertSame(strtoupper($method), strtoupper($request->getMethod()));
            $this->assertSame('test', $request->getUri()->getPath());
            $this->assertSame('ApiKey bigseretdonttellanyone', $request->getHeader('Authorization')[0]);
        });

        if ($exception) {
            $this->expectException($exception);
        }
        if ($method === 'post') {
            $client->{$method}('test', ['foo' => 'bar']);
        } else {
            $client->{$method}('test');
        }
    }

    private function getMockedClient(int $responseCode, string $responseBody, ?callable $assertClosure = null): AuthorizedClient
    {
        $fakeClient = new AuthorizedClient('https://example.com/api/v2/', 'bigseretdonttellanyone');

        $handlerStack = HandlerStack::create(new MockHandler([
            new Response($responseCode, [], $responseBody),
        ]));

        if ($assertClosure !== null) {
            $handlerStack->push(function (callable $handler) use ($assertClosure) {
                return function (RequestInterface $request, $options) use ($handler, $assertClosure) {
                    $assertClosure($request);
                    return $handler($request, $options);
                };
            });
        }

        $fakeClient->setClient(new Client(['handler' => $handlerStack]));

        return $fakeClient;
    }
}
