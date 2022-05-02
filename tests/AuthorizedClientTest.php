<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LoggerInterface;
use SandwaveIo\RealtimeRegister\Exceptions\BadRequestException;
use SandwaveIo\RealtimeRegister\Exceptions\ForbiddenException;
use SandwaveIo\RealtimeRegister\Exceptions\NotFoundException;
use SandwaveIo\RealtimeRegister\Exceptions\RealtimeRegisterClientException;
use SandwaveIo\RealtimeRegister\Exceptions\UnauthorizedException;
use SandwaveIo\RealtimeRegister\Support\AuthorizedClient;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

/** @covers \SandwaveIo\RealtimeRegister\Support\AuthorizedClient */
class AuthorizedClientTest extends TestCase
{
    public function test_construct(): void
    {
        $client = new AuthorizedClient('https://example.com/api/v2/', 'bigsecretdonttellanyone');
        $this->assertInstanceOf(AuthorizedClient::class, $client);
    }

    public function requestVariants(): array
    {
        return [
            'GET request: success'  => ['get', 200, null],
            'GET request: bad request'  => ['get', 400, BadRequestException::class],
            'GET request: unauthorized'  => ['get', 401, UnauthorizedException::class],
            'GET request: forbidden'  => ['get', 403, ForbiddenException::class],
            'GET request: not found'  => ['get', 404, BadRequestException::class],
            'GET request: not found (deprecated)'  => ['get', 404, NotFoundException::class],
            'GET request: error'  => ['get', 500, RealtimeRegisterClientException::class],
            'GET request: bad gateway'  => ['get', 502, RealtimeRegisterClientException::class],
            'GET request: service unavailable'  => ['get', 503, RealtimeRegisterClientException::class],

            'POST request: success'  => ['post', 201, null],
            'POST request: bad request'  => ['post', 400, BadRequestException::class],
            'POST request: unauthorized'  => ['post', 401, UnauthorizedException::class],
            'POST request: forbidden'  => ['post', 403, ForbiddenException::class],
            'POST request: not found'  => ['post', 404, BadRequestException::class],
            'POST request: not found (deprecated)'  => ['post', 404, NotFoundException::class],
            'POST request: error'  => ['post', 500, RealtimeRegisterClientException::class],
            'POST request: bad gateway'  => ['post', 502, RealtimeRegisterClientException::class],
            'POST request: service unavailable'  => ['post', 503, RealtimeRegisterClientException::class],

            'PUT request: success'  => ['put', 200, null],
            'PUT request: success (204)'  => ['put', 204, null],
            'PUT request: bad request'  => ['put', 400, BadRequestException::class],
            'PUT request: unauthorized'  => ['put', 401, UnauthorizedException::class],
            'PUT request: forbidden'  => ['put', 403, ForbiddenException::class],
            'PUT request: not found'  => ['put', 404, BadRequestException::class],
            'PUT request: not found (deprecated)'  => ['put', 404, NotFoundException::class],
            'PUT request: error'  => ['put', 500, RealtimeRegisterClientException::class],
            'PUT request: bad gateway'  => ['put', 502, RealtimeRegisterClientException::class],
            'PUT request: service unavailable'  => ['put', 503, RealtimeRegisterClientException::class],

            'DELETE request: success'  => ['delete', 200, null],
            'DELETE request: bad request'  => ['delete', 400, BadRequestException::class],
            'DELETE request: unauthorized'  => ['delete', 401, UnauthorizedException::class],
            'DELETE request: forbidden'  => ['delete', 403, ForbiddenException::class],
            'DELETE request: not found'  => ['delete', 404, BadRequestException::class],
            'DELETE request: not found (deprecated)'  => ['delete', 404, NotFoundException::class],
            'DELETE request: error'  => ['delete', 500, RealtimeRegisterClientException::class],
            'DELETE request: bad gateway'  => ['delete', 502, RealtimeRegisterClientException::class],
            'DELETE request: service unavailable'  => ['delete', 503, RealtimeRegisterClientException::class],
        ];
    }

    /** @dataProvider requestVariants */
    public function test_http_methods(string $method, int $response, ?string $exception): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $logger->method('debug');

        $client = MockedClientFactory::makeAuthorizedClient(
            static fn (): Response => new Response($response),
            function (RequestInterface $request) use ($method) {
                $this->assertSame(strtoupper($method), strtoupper($request->getMethod()));
                $this->assertSame('test', $request->getUri()->getPath());
                $this->assertSame('ApiKey bigsecretdonttellanyone', $request->getHeader('Authorization')[0]);
            },
            $logger
        );

        if ($exception) {
            $this->expectException($exception);
        }
        if ($method === 'post') {
            $client->{$method}('test', ['foo' => 'bar']);
        } else {
            $client->{$method}('test');
        }
    }

    public function test_get_with_specific_return_code(): void
    {
        $client = MockedClientFactory::makeAuthorizedClient(
            static fn (): Response => new Response(201, [], 'test')
        );
        $response = $client->get('test', [], 201);
        $this->assertSame('test', $response->text());
    }

    public function test_get_with_specific_return_code_mismatch(): void
    {
        $client = MockedClientFactory::makeAuthorizedClient(
            static fn (): Response => new Response(200)
        );
        $this->expectException(RealtimeRegisterClientException::class);
        $client->get('test', [], 201);
    }

    public function test_get_with_specific_return_code_notfound(): void
    {
        $client = MockedClientFactory::makeAuthorizedClient(
            static fn (): Response => new Response(404)
        );
        $this->expectException(NotFoundException::class);
        $client->get('test', [], 201);
    }

    public function test_get_mocked_headers(): void
    {
        $client = MockedClientFactory::makeAuthorizedClient(
            static fn (): Response => new Response(
                202,
                [
                    'X-Process-Id' => 1,
                    'Content-Type' => 'application/json',
                ]
            )
        );

        $response = $client->get('test');

        self::assertCount(2, $response->headers());
        self::assertCount(1, $response->headers()['X-Process-Id']);
        self::assertCount(1, $response->headers()['Content-Type']);
        self::assertSame(1, (int) $response->headers()['X-Process-Id'][0]);
        self::assertSame('application/json', $response->headers()['Content-Type'][0]);
    }
}
