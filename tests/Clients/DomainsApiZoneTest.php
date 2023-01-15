<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\DomainZone;
use SandwaveIo\RealtimeRegister\Domain\DomainZoneRecord;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainsApiZoneTest extends TestCase
{
    public function test_zone(): void
    {
        $validDomainZoneDetails = include __DIR__ . '/../Domain/data/domain_zone_details.php';
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode($validDomainZoneDetails),
            MockedClientFactory::assertRoute('GET', 'v2/domains/example.com/zone', $this)
        );

        $response = $sdk->domains->zone('example.com');

        $this->assertInstanceOf(DomainZone::class, $response);
        $this->assertSame($validDomainZoneDetails, $response->toArray());
        $this->assertInstanceOf(DomainZoneRecord::class, $response->records[0]);
    }
}
