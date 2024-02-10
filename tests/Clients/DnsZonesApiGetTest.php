<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DnsZonesApiGetTest extends TestCase
{
    public function test_get(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/dnszone_valid_with_records.php'),
            MockedClientFactory::assertRoute('GET', 'v2/dns/zones/1111111111', $this)
        );

        $response = $sdk->dnszones->get(1111111111);
        $this->assertSame(2, $response->records->count());
    }
}
