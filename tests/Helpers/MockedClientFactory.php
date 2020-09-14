<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LoggerInterface;
use SandwaveIo\RealtimeRegister\RealtimeRegister;
use SandwaveIo\RealtimeRegister\Support\AuthorizedClient;

class MockedClientFactory
{
    const API_KEY = 'bigseretdonttellanyone';

    public static function assertRoute(string $method, string $route, TestCase $testCase): callable
    {
        return function (RequestInterface $request) use ($method, $route, $testCase) {
            $testCase->assertSame(strtoupper($method), strtoupper($request->getMethod()));
            $testCase->assertSame($route, $request->getUri()->getPath());
            $testCase->assertSame('ApiKey ' . static::API_KEY, $request->getHeader('Authorization')[0]);
        };
    }

    public static function makeSdk(int $responseCode, string $responseBody, ?callable $assertClosure = null): RealtimeRegister
    {
        $sdk = new RealtimeRegister('bigseretdonttellanyone');
        $sdk->setClient(static::makeAuthorizedClient($responseCode, $responseBody, $assertClosure));
        return $sdk;
    }

    public static function makeAuthorizedClient(int $responseCode, string $responseBody, ?callable $assertClosure = null, ?LoggerInterface $logger = null): AuthorizedClient
    {
        $fakeClient = new AuthorizedClient('https://example.com/api/v2/', 'bigseretdonttellanyone', [], $logger);

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
