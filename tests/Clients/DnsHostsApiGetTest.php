<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DnsHostsApiGetTest extends TestCase
{
    public function test_get(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/hosts.php'),
            MockedClientFactory::assertRoute('GET', 'v2/hosts/example.com', $this)
        );

        $response = $sdk->hosts->get('example.com');
        $this->assertSame('ns1.example.com', $response->hostName);
    }
}
