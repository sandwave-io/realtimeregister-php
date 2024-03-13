<?php declare(strict_types = 1);

namespace Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Zone;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ZoneApiGetTest extends TestCase
{
    public function test_get(): void
    {
        $validZoneDetails = include __DIR__ . '/../Domain/data/zone_valid.php';
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode($validZoneDetails),
            MockedClientFactory::assertRoute('GET', 'v2/dns/zones/1', $this)
        );

        $response = $sdk->dnszones->get(1);

        $this->assertInstanceOf(Zone::class, $response);
        $this->assertSame($validZoneDetails, $response->toArray());
    }
}
